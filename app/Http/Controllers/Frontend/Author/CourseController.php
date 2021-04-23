<?php

namespace App\Http\Controllers\Frontend\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use App\Repositories\Contracts\ICategory;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CourseResource;


class CourseController extends Controller
{
    
    protected $courses;
    protected $categories;

    public function __construct(ICourse $courses, ICategory $categories)
    {
        $this->courses = $courses;
        $this->categories = $categories;
    }
    
    public function create()
    {

        $categories = CategoryResource::collection($this->categories->fetchAll());
        return view('frontend.author.course.Create', compact('categories'));
    }
    
    public function basics($uuid)
    {
        $course = new CourseResource($this->courses->findByUuid($uuid));
        $categories = CategoryResource::collection($this->categories->fetchAll());
        return view('frontend.author.course.Basics', compact('course', 'categories'));
    }
    
    public function curriculum($uuid)
    {
        $course = $this->courses->findByUuid($uuid);
        return view('frontend.author.course.Curriculum', compact('course'));
    }
    
    public function pricing($uuid)
    {
        $course = $this->courses->findByUuid($uuid);
        return view('frontend.author.course.Pricing', compact('course'));
    }
    
    public function goals($uuid)
    {
        $course = $this->courses->findByUuid($uuid);
        return view('frontend.author.course.Goals', compact('course'));
    }

    public function approvals($uuid)
    {
        $approvals = $this->courses->fetchCourseApprovals($uuid);
        $course = $this->courses->findByUuid($uuid);
        return view('frontend.author.course.Approvals', compact('approvals', 'course'));
    }
}