<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\CourseResource;
use App\Repositories\Contracts\IUser;

class SearchController extends Controller
{
    
    protected $courses;
    protected $users;
    
    public function __construct(ICourse $courses, IUser $users)
    {
        $this->courses = $courses;
        $this->users = $users;
    }
    
    
    public function filters(Request $request)
    {
        $courses = $this->courses->search($request);
        return CourseResource::collection($courses);
    }
    
    public function fetchFilterParameters($category)
    {
        $filters = $this->courses->getFilterParameters($category);
        return response()->json($filters, 200);
    }
    

    // Autocomplete
    public function fetchAutocompleteUsers(Request $request)
    {
        $search_term = $request->search;
        $users = $this->users->getAutocomplete($search_term);
    	return response()->json($users);
    }


    public function fetchAutocompleteCourses(Request $request)
    {
        $search_term = $request->search;
        $courses = $this->courses->getAutocomplete($search_term);
    	return response()->json($courses);
    }
    
    
}
