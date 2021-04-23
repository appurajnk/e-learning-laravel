<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use App\Models\Category;
use App\Models\Attachment;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Events\UpdateCourseStats;

class CourseRepository  extends RepositoryAbstract implements ICourse
{
    
    public function entity()
    {
        return Course::class;
    }
    
    
    public function create(array $data)
    {
        
        $course = auth()->user()->authored_courses()->create([
            'title' => $data['title'],
        	'subtitle' => $data['subtitle'],
        	'category_id' => $data['category'],
        	'slug' => \Str::slug($data['title'])
        ]);
        
        
        $section = $course->sections()->create([
            'title' => 'Start here',
            'objective' => 'Short course objective',
            'sortOrder' => 1     
        ]);
        
        $section->lessons()->create([
            'title' => 'Introduction',
            'course_id' => $course->id,
            'sortOrder' => 1
        ]);
        
        event(new UpdateCourseStats($course, 'course_content_stats'));
        return $course;
        
    }
    
    
    public function findByUuid($uuid)
    {
        $course = Course::where('uuid', $uuid)->with('author')->first();
        return $course;
    }
    
    
    public function update(array $data, $id)
    {
        $course = $this->find($id);

        $course->update([
            'title' => $data['title'],
        	'subtitle' => $data['subtitle'],
        	'category_id' => $data['category'],
        	'slug' => \Str::slug($data['title']),
        	'description' => $data['description'],
        	'level' => $data['level'],
        	'language' => $data['language']
        ]);

        //$course->syncTags($data['topics']);
        
    }
    
    public function updatePrice(array $data, $id)
    {
        
        $course = $this->find($id);
        $course->price = $data['price'];
        $course->save();
        return $course;
        
    }
    
    public function updateCourseImage($filename, $id)
    {
        $course = $this->find($id);
        $course->image = $filename;
        $course->save();
        
    }
    
    public function getAutocomplete($search_term)
    {
        $courses = Course::where(function($q) use ($search_term){
            $q->where('title', 'LIKE', '%'.$search_term.'%')
              ->orWhere('slug', 'LIKE', '%'.$search_term.'%')
              ->orWhere('subtitle', 'LIKE', '%'.$search_term.'%')
              ->orWhere('description', 'LIKE', '%'.$search_term.'%');
            })
            ->where('published', true)
            ->where('approved', true)
            ->get();
        
        return $courses;	
    }
    
    public function search(Request $request)
    {

        $builder = (new Course)->newQuery();
        
        $builder->where('published', true)
                    ->where('approved', true);

        if($request->languages){
            $builder->whereIn('language', $request->languages);
        }
        
        if($request->levels){
            $builder->whereIn('level', $request->levels);
        }
        
        if($request->category){
            if($request->is_subcategory){
                $subcat = Category::find($request->category);
                $builder->where('category_id', $subcat->id);
            } else {
                $cat = Category::find($request->category);
                $builder->whereHas('category', function($q) use ($cat){
                $q->where('parent_id', $cat->id); 
                });
            }
        }

        if($request->subcategories){
            $builder->whereIn('category_id', $request->subcategories);
        }
        
        if($request->price){
            if($request->price == 'free'){
                $builder->where('price', 0);
            }
            if($request->price == 'paid'){
                $builder->where('price', '>', 0);
            }
        }
        
        if($request->rating){
            $val = $request->rating;
            $builder->join('reviews', 'reviews.course_id', '=', 'courses.id')
                    ->select(\DB::raw('avg(rating) as average, courses.*'))
                    ->groupBy('course_id')
                    ->havingRaw('avg(rating) >= ?', [$val]);
        }

        // if request is from search box
        if($request->q){
            $search_term = $request->q;
            $builder->where(function($s) use ($search_term){
                $s->where('courses.title', 'LIKE', '%'.$search_term.'%')
                  ->orWhere('courses.slug', 'LIKE', '%'.$search_term.'%')
                  ->orWhere('courses.subtitle', 'LIKE', '%'.$search_term.'%')
                  ->orWhere('courses.description', 'LIKE', '%'.$search_term.'%');
                });
        }

        // ordering
        if($request->orderBy=='price_a-z'){
            $builder->orderBy('price', 'asc');
        }
        
        if($request->orderBy=='price_z-a'){
            $builder->orderBy('price', 'desc');
        }
        
        if($request->orderBy=='newest'){
            $builder->latest();
        }

        if($request->orderBy=='rating'){
            if($request->rating){
                $builder->orderBy('average', 'desc');
            } else {
                $builder->orderByJoin('reviews.rating', 'desc', 'AVG');
            }
        }
        

        $courses = $builder->with(['category', 'what_to_learn', 'requirements', 'target_students', 'author'])->paginate(5, ['*'], 'page', $request->page);
 
        
        return $courses;
        
    }
    
    public function getFilterParameters($category)
    {
        $category = Category::find($category);
        $subcategories = $category->children()->has('courses')->get();
        
        // language
        $languages = Course::distinct()->get(['language'])->pluck('language');
        
        // levels
        $levels = Course::distinct()->get(['level'])->pluck('level');
        
        $response = [
            'subcategories' => $subcategories,
            'languages' => $languages,
            'levels' => $levels
        ];
        
        return $response;
        
        
    }
    
    
    public function findBySlug($slug)
    {
        
        $course = Course::where('slug', $slug)->with([
            'sections', 'sections.lessons', 
            'sections.lessons.video', 'author', 
            'what_to_learn', 'requirements', 'target_students'
        ])->first();
        
        if($course){
            $course->first_lesson = get_first_lesson($course);
        }
        
        return $course;
        
    }
    
    
    public function findWhereIn($field, array $data)
    {
        return Course::whereIn($field, $data)->get();
    }
    
    public function checkIfUserCanAccess($id)
    {
        $course = $this->find($id);
        $can_access = auth()->user()->canAccessCourse($course);
        return response()->json(['user_can_access' => $can_access], 200);
    }

    public function checkIfUserCanAccessBySlug($slug)
    {
        $course = Course::whereSlug($slug)->first();
        if($course){
            $can_access = auth()->user()->canAccessCourse($course);
            return response()->json(['user_can_access' => $can_access], 200);
        } else {
            return response()->json(['user_can_access' => false], 404);
        }
        
    }

    public function getFirstVideoLesson($course)
    {
        $lesson = $course->lessons()->hasContent()
                            ->whereIn('content_type', ['video', 'youtube'])
                            ->with('video')
                            ->first();
        return $lesson;
    }
    
    
    public function fetchDashboardHeaderInformation($id)
    {
        $course = $this->find($id);
        $first_lesson =  Lesson::whereHas('section', function($q) use ($id){
                $q->where('course_id', $id)
                  ->orderBy('sortOrder', 'asc');
            })
            ->orderBy('sortOrder', 'asc')
            ->first();
        $lessons = Lesson::whereIn('section_id', $course->sections->pluck('id'))->pluck('id');
        
        $last_watched = auth()->user()->completions()->latest()
                            ->whereIn('lessons.id', $lessons)->first();
        
        $published_lessons = $course->lessons()->hasContent()->count();

        $data = [
            'uuid' => $last_watched ? $last_watched->uuid : $first_lesson->uuid,
		    'lastWatched' => $last_watched,
		    'firstLesson' => $first_lesson,
		    'totalLessons' => $published_lessons,
		    'totalCompleted' => auth()->user()->completions()->whereIn('lesson_id', $lessons)->count(),
		    'percentCompleted' => auth()->user()->percentCompleted($course),
		    'userRating' => $course->reviews()->where('user_id', auth()->id())->first()
	    ];
	    
	    return $data;
    }

    public function getAttachments($id)
    {
        $attachments = Attachment::whereHas('lesson', function($q) use ($id) {
            $q->where('course_id', $id);
        })
        ->with('lesson')
        ->get();

        return $attachments;
    }
    
    public function deleteAttachment($id)
    {
        $attachment = Attachment::find($id);
        if(\Storage::disk('server')->exists('attachments/'.$attachment->file_name)){
            \Storage::disk('server')->delete('attachments/'.$attachment->file_name);
        }
        $attachment->delete();
    }
    
    public function resetProgress($id)
    {
        $course = $this->find($id);
        $lessons = Lesson::whereIn('section_id', $course->sections->pluck('id'))->pluck('id');
        auth()->user()->completions()->detach($lessons);
    }
    
    
    public function fetchOverviewInfo($id)
    {
        $course = $this->find($id);
        $questions = $course->questions()->with('user')->latest()->get()->take(2);
        $announcements = $course->announcements()->with('user')->latest()->get()->take(2);
        $data=[
            'questions' => $questions,
            'announcements' => $announcements
        ];
        
        return $data;
    }
    
    
    public function submitForReview($uuid)
    {
        $course = Course::where('uuid', $uuid)->first();
        // check if all lessons have content
        $lessons_with_no_content =  $course->lessons()->hasNoContent()->count() == 0;

        $course_has_description = !empty($course->description);
        $target_students = $course->target_students()->count() > 0;
        $what_to_learn = $course->what_to_learn()->count() > 0;
        $requirements = $course->requirements()->count() > 0;
        $course_image = !is_null($course->image);
        $overall = $lessons_with_no_content && $course_has_description && $target_students && $what_to_learn && $requirements && !is_null($course->image);
        
        if($overall == false){
            return [
                'content_check_passed' => $lessons_with_no_content,
                'target_students_passed' => $target_students,
                'what_to_learn_passed' => $what_to_learn,
                'requirements_passed' => $requirements,
                'course_image_passed' => ! is_null($course->image),
                'course_description_passed' => $course_has_description,
                'overall_passed' => $lessons_with_no_content && $target_students && $what_to_learn && $requirements && !is_null($course->image)
            ];
        }
        
        // submit the course for review
        $course->published = true;
        $course->approved = false;
        $course->save();
        
        event(new UpdateCourseStats($course, 'course_content_stats'));
        return ['message' => 'ok'];
        
    }

    /**********
        ADMIN
    ********/
    public function getAdminCourses(array $data)
    {
        $builder = (new Course)->newQuery();
        
        if(filter_var($data['pendingOnly'], FILTER_VALIDATE_BOOLEAN) == true){
            $builder->where('published', true)->where('approved', false);
        }
        
        if($data['query']){
            $builder->where('title', 'like', '%'.$data['query'].'%');
        }
        
        if($data['category']){
            $builder->where('category_id', $data['category']);
        }
        
        if($data['sort'] == 'category.name'){
            $builder->orderByJoin('category.name', $data['direction']);
        } elseif($data['sort'] == 'author.full_name') {
            $builder->orderByJoin('author.first_name', $data['direction']);
        } else {
            $builder->orderBy($data['sort'], $data['direction']);
        }
        
        $courses = $builder->with(['category', 'author', 'sections'])
                            ->paginate($data['limit']);
        
        return $courses;
    }
    
    public function approve(Request $request, $uuid)
    {
        $course = $this->findByUuid($uuid);
        $course->approvals()->create([
            'comment' => $request->comment,
            'decision' => $request->decision
        ]);
        
        if($request->decision == 'approved'){
            $course->published = true;
            $course->approved = true;
        } else {
            $course->published = false;
            $course->approved = false;
        }
        
        $course->save();
        
        return $course;
    }
    
    public function fetchCourseApprovals($uuid)
    {
        $course = $this->findByUuid($uuid);
        return $course->approvals()->latest()->get();
    }
}






