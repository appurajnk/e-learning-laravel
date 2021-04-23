<?php

namespace App\Http\Controllers\Frontend\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\UserResource;


class DashboardController extends Controller
{
    
    protected $courses;

    public function __construct(ICourse $courses)
    {
        $this->courses = $courses;
    }
    
    public function overview()
    {
        return redirect()->route('frontend.author.dashboard.courses');
        //return view('frontend.author.dashboard.Overview');
    }
    
    public function courses()
    {
        return view('frontend.author.dashboard.Courses');
    }
    
    public function qna()
    {
        return view('frontend.author.dashboard.Questions');
    }
    
    public function reviews()
    {
        return view('frontend.author.dashboard.Reviews');
    }
    
    public function announcements()
    {
        return view('frontend.author.dashboard.Announcements');
    }
    
    public function revenue()
    {
        return view('frontend.author.dashboard.Revenue');
    }
    
    public function statement($statement)
    {
        //$sales = $this->revenue->fetchStatementDetails($statement);
        return view('frontend.author.dashboard.StatementDetails', compact('statement'));
    }
    
    
}