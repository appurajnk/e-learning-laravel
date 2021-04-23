<?php

namespace App\Http\Controllers\Api\v1\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use App\Repositories\Contracts\ICategory;
use App\Http\Resources\CourseResource;
use App\Notifications\Frontend\AuthorCourseApproval;

class AdminCourseController extends Controller
{
    protected $courses;
    
    public function __construct(ICourse $courses, ICategory $categories)
    {
        $this->courses = $courses;
        $this->categories = $categories;
    }
    
    public function index(Request $request)
    {
        $courses = $this->courses->getAdminCourses($request->all());
        return CourseResource::collection($courses);
    }
    
    public function approval(Request $request, $uuid)
    {
        $this->validate($request, [
            'comment' => 'required',
            'decision' => 'required|in:approved,disapproved'
        ]);
        $course = $this->courses->approve($request, $uuid);
        
        
        try{
            //$when = now()->addMinutes(10);
            $course->author->notify(new AuthorCourseApproval($course));
            //$course->author->notify((new AuthorCourseApproval($course))->delay($when));
        } catch(\Exception $e){
            // Report the exception but continue with the request without rendering an error page
            report($e);
            return response()->json(null, 200);
        }

        
    }
    
    public function fetchCourseApprovals($uuid)
    {
        $approvals = $this->courses->fetchCourseApprovals($uuid);
        return response()->json($approvals, 200);
    }
    
    public function fetchCourse($uuid)
    {
        $approvals = $this->courses->fetchCourseApprovals($uuid);
        $course = $this->courses->findByUuid($uuid);

        return response()->json([
            'course' => $course,
            'approvals' => $approvals
        ], 200);
    }

    public function fetchCategoriesWithCourses()
    {
        $subcategories = $this->categories->findCategoriesWithCourses();
        return response()->json($subcategories, 200);
    }
}
