<?php

namespace App\Http\Controllers\Api\v1\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IHome;
use App\Http\Resources\CourseResource;

class HomeController extends Controller
{
    

    protected $home;

    public function __construct(IHome $home)
    {
        $this->home = $home;
    }


    public function getMostViewedCourses()
    {
        $courses = $this->home->getMostViewedCourses();
        return CourseSimpleResource::collection($courses);
    }

    public function getCategoryCourses(Request $request)
    {
        $courses = $this->home->getCategoryCourses($request->category);
        return CourseResource::collection($courses);
    }
}
