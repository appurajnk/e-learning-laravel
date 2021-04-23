<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use App\Repositories\Contracts\ILesson;
use App\Repositories\Contracts\IQuestion;
use App\Http\Resources\UserResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\SectionResource;

class CourseController extends Controller
{
    
    protected $courses;
    protected $lessons;
    protected $questions;
    
    public function __construct(ICourse $courses, ILesson $lessons, IQuestion $questions)
    {
        $this->courses = $courses;
        $this->lessons = $lessons;
        $this->questions = $questions;
    }
    
    public function search(Request $request)
    {
        $query = $request->q;
        if(! $query){
            return redirect()->route('frontend.404');
        }
        return view('frontend.courses.Search', compact('query'));
    }
    
    public function show($slug)
    {
        
        $course = $this->courses->findBySlug($slug);
        if(! $course){
            return redirect()->route('frontend.404');
        }
        // check if course is live
        if(!$course->isLive()){
            return redirect()->back();
        }
        views($course)->delayInSession(30)->record();
        if(auth()->check() && auth()->user()->canAccessCourse($course)){
            return redirect()->route('frontend.course.dashboard.overview', ['slug' => $course->slug]);
        }
        
        $preview_lesson = $this->courses->getFirstVideoLesson($course);
        return view('frontend.courses.Show')
                    ->with([
                        'course' => new CourseResource($course),
                        'preview' => new LessonResource($preview_lesson)
                    ]);
    }
    
    
    public function DashboardOverview($slug)
    {
        $course = $this->courses->findBySlug($slug);
        if(!auth()->user()->canAccessCourse($course)){
            return redirect()->route('frontend.course.show', ['slug' => $course->slug]);
        }
        views($course)->delayInSession(30)->record();
        return view('frontend.courses.dashboard.Overview')
                    ->with(['course' => new CourseResource($course)]);
    }
    
    
    public function DashboardContent($slug)
    {
        $course = $this->courses->findBySlug($slug);
        if(!auth()->user()->canAccessCourse($course)){
            return redirect()->route('frontend.course.show', ['slug' => $course->slug]);
        }
        return view('frontend.courses.dashboard.Content')
                    ->with(['course' => new CourseResource($course)]);
    }

    public function DashboardAnnouncements($slug)
    {
        $course = $this->courses->findBySlug($slug);
        if(!auth()->user()->canAccessCourse($course)){
            return redirect()->route('frontend.course.show', ['slug' => $course->slug]);
        }
        $user = auth()->user();

        return view('frontend.courses.dashboard.Announcements')
                        ->with([
                            'user' => new UserResource($user), 
                            'course' => new CourseResource($course)
                        ]);
    }
    
    public function Play($slug, $uuid)
    {

        $course = $this->courses->findBySlug($slug);
        if(! $course){
            return redirect()->route('frontend.404');
        }
        
        if(!auth()->user()->canAccessCourse($course)){
            return redirect()->route('frontend.course.show', ['slug' => $course->slug]);
        }

        if(!$course->isLive()){
            return redirect()->back();
        }
        views($course)->delayInSession(30)->record();

        $data = $this->lessons->findByUuid($uuid);

        return view('frontend.courses.player.Play')
            ->with([
                'sections' => new SectionResource($data['sections']),
                'course' => new CourseResource($course),
                'playing' => new LessonResource($data['playing']),
                'next' => $data['next'] ? new LessonResource($data['next']) : null,
                'previous' => $data['previous'] ? new LessonResource($data['previous']) : null,
                'attachments' => $data['attachments']
            ]);
    }
    
    public function DashboardQuestions($slug)
    {
        $course = $this->courses->findBySlug($slug);
        if(!auth()->user()->canAccessCourse($course)){
            return redirect()->route('frontend.course.show', ['slug' => $course->slug]);
        }
        return view('frontend.courses.dashboard.Questions')
                    ->with(['course' => new CourseResource($course)]);
    }
    
    public function DashboardShowQuestion($slug, $uuid)
    {
        $course = $this->courses->findBySlug($slug);
        if(!auth()->user()->canAccessCourse($course)){
            return redirect()->route('frontend.course.show', ['slug' => $course->slug]);
        }
        $user = auth()->user();
        $question = $this->questions->fetchQuestion($uuid);

        return view('frontend.courses.dashboard.QuestionShow')
                            ->with([
                                'question' => $question,
                                'course' => new CourseResource($course)
                            ]);
    }
    
    
}
