<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use App\Repositories\Contracts\ICategory;
use App\Http\Resources\CourseResource;

class AdminCourseController extends Controller
{
    
    protected $courses;
    protected $categories;
    
    public function __construct(ICourse $courses, ICategory $categories)
    {
        $this->courses = $courses;   
        $this->categories = $categories;   
    }
    
    public function index()
    {
  
        $subcategories = $this->categories->findCategoriesWithCourses();
        return view('backend.courses.Index', compact('subcategories'));
    }
    
    public function details($uuid)
    {
        $course = new CourseResource($this->courses->findByUuid($uuid));
        return view('backend.courses.Details', compact('course'));
    }
    
    public function featured()
    {
        return view('backend.courses.Featured');
    }
}
