<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use App\Models\Section;
use App\Models\Attachment;
use App\Repositories\Contracts\ILesson;
use App\Http\Resources\LessonResource;
use App\Events\UpdateCourseStats;


class LessonRepository extends RepositoryAbstract implements ILesson
{
    
    public function entity()
    {
        return Lesson::class;
    }
    

    public function findById($id)
    {
        return Lesson::find($id);
    }
    
    public function updateDraggable(array $data)
    {
        foreach($data as $d){
            $lesson = Lesson::find($d['id']);
            $lesson->sortOrder = $d['sortOrder'];
            $lesson->section_id = $d['section_id'];
            $lesson->save();
        }
    }
    
    public function findByCourse($id){
        $lessons = Lesson::where('course_id', $id)->orderBy('sortOrder')->get();
        return LessonResource::collection($lessons);
    }
    
    public function findBySection($id){
        $lessons = Lesson::where('section_id', $id)->orderBy('sortOrder')->get();
        return LessonResource::collection($lessons);
    }
    
    public function create(array $data)
    {
        $maxSection = Section::find($data['section']);
        $maxSort = \DB::table('lessons')->where('section_id', $maxSection->id)->max('sortOrder');
        
        $lesson = Lesson::create([
            'course_id' => $maxSection->course_id,
            'section_id' => $maxSection->id,
            'title' => $data['title'],
            'description' => $data['description'],
        	'sortOrder' => $maxSort+1,
            'lesson_type' => $data['lesson_type'],
        ]);
        
        event(new UpdateCourseStats($lesson->course, 'course_content_stats'));
        
        return $lesson;
    }
    
    public function update(array $data, $id)
    {
        $lesson = $this->find($id);
        $lesson->update([
           'title' => $data['title'],
           'description' => $data['description']
        ]);
        
        return $lesson;
    }
    
    public function findByUuid($uuid)
    {
        $lesson = Lesson::with('video')->where('uuid', $uuid)->first();
        
        
        // mark this lesson as completed
        if(! auth()->user()->hasCompletedLesson($lesson)){
            auth()->user()->completions()->attach($lesson->id);
        }
        
        $sections = Section::with(['lessons' => function($q){
                $q->orderBy('sortOrder', 'asc');
                $q->with('video');
            }])
            ->where('course_id', $lesson->section->course->id)
            ->orderBy('sortOrder', 'asc')
            ->get();
        
        $sec_array = $sections->pluck('id');
        
        $lessons = Lesson::whereIn('section_id', $sec_array)
                    ->join('sections', 'lessons.section_id', '=', 'sections.id')  
                    ->orderBy('sections.sortOrder', 'asc')
                    ->orderBy('lessons.sortOrder', 'asc')
                    ->select('lessons.*')
                    ->get();
                  
        $lessons = $lessons->each(function ($item, $key){
            $item->position = $key;
        });
        
        $playing = $lessons->where('uuid', $lesson->uuid)->first();
        $next = $lessons->where('position', $playing->position+1)->first(); 
        $previous = $lessons->where('position', $playing->position-1)->first();
        
        
        // if this is the last lesson by this user, then generate course certificate
        $course = $lesson->section->course;

        $pcnt_course_complete = auth()->user()->percentCompleted($course);
        if($pcnt_course_complete >= 100 && !auth()->user()->hasCompletedCourse($course)){
            auth()->user()->certificates()->create([
                'course_id' => $course->id,
                'certificate_no' => 'C00'.strToUpper(\Str::random(2)).$course->category->id.'-'. auth()->user()->id . rand(100, 999).rand(3,99),
                'course_title' => $course->title,
                'course_subtitle' => $course->subtitle,
                'video_hours' => $course->get_total_video_hours(),
                'total_articles' => $course->get_total_articles(),
                'total_quizzes' => 0
                //'total_quizzes' => $course->total_quizzes
            ]);
        }
        
        $data = [
            'course' => $course,
            'playing' => $playing,
            'next' => $next,
            'previous' => $previous,
            'sections' => $sections,
            'attachments' => $playing->attachments
        ];
        return $data;
        
    }
    
    public function markAsComplete($id)
    {
        $lesson = $this->find($id); 
        $course = $lesson->section->course;
        $user = auth()->user();
        
        if(!$user->hasCompletedLesson($lesson)){
            $user->completions()->attach($lesson->id);
            $pcnt_course_complete = $user->percentCompleted($course);
            
            if($pcnt_course_complete == 100 && !$user->hasCompletedCourse($course)){
                $user->certificates()->create([
                    'course_id' => $course->id,
                    'course_title' => $course->title,
                    'certificate_no' => 'C00'.strToUpper(str_random(2)).$course->category->id.'-'. $user->id . rand(100, 999).rand(3,99),
                    'course_subtitle' => $course->subtitle,
                    'video_hours' => $course->total_hours,
                    'total_articles' => $course->total_articles,
                    'total_quizzes' => $course->total_quizzes    
                ]);
            }
        } else {
            $user->completions()->detach($lesson->id);
        }
        
        
        return response()->json(null, 200);
        
    }

    public function addAttachment(array $data)
    {
        $attachment = Attachment::create($data); 
        return $attachment;
    }
    
    
    
}









