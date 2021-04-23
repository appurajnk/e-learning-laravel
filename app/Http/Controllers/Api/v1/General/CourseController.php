<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    protected $courses;

    public function __construct(ICourse $courses)
    {
        $this->courses = $courses;
    }

    public function find($id)
    {
        $course = $this->courses->find($id);
        
        return new CourseResource($course);
    }
    
    public function findBySlug($slug)
    {
        $course = $this->courses->findBySlug($slug);
        if($course){
            return new CourseResource($course);
        } else {
            return response()->json(null, 404);
        }
        
    }

    public function checkIfUserCanAccess($id)
    {
        if( ! auth()->check()){
            return response()->json(['user_can_access' => false], 200);
        }
        return $this->courses->checkIfUserCanAccess($id);
    }
    
    public function checkIfUserCanAccessBySlug($slug)
    {
        if( ! auth()->check()){
            return response()->json(['user_can_access' => false], 200);
        }
        return $this->courses->checkIfUserCanAccessBySlug($slug);
    }
    
    
    public function DashboardHeaderInformation($id)
    {
        $data = $this->courses->fetchDashboardHeaderInformation($id);
        return response()->json($data, 200);
    }
    
    public function ResetProgress($id)
    {
        $this->courses->resetProgress($id);
        return response()->json(null, 200);
    }
    
    public function fetchOverviewInfo($id)
    {
        $info = $this->courses->fetchOverviewInfo($id);
        return response()->json($info, 200);
    }
    
    
}





