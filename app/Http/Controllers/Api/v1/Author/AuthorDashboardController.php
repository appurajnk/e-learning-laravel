<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IAuthorDashboard;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ReviewResource;

class AuthorDashboardController extends Controller
{
    protected $dashboard;

    public function __construct(IAuthorDashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }
    
    
    public function findAuthorCourses(Request $request)
    {
        $courses = $this->dashboard->findAuthorCourses($request->all());

        return response()->json([
            'live' => CourseResource::collection($courses['live']),
            'draft' => CourseResource::collection($courses['draft'])
        ], 200);
    }
    
    public function findAuthorReviews(Request $request)
    {
        $reviews = ReviewResource::collection($this->dashboard->findAuthorReviews($request->all()));
        return $reviews;
    }
    
}
