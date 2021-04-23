<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IAuthorDashboard;

class AuthorDashboardRepository  extends RepositoryAbstract implements IAuthorDashboard
{
    public function entity()
    {
        return Course::class;
    }
    
    public function findAuthorCourses(array $data)
    {
        $q = $data['query'];
        $order = $data['orderBy'];
        
        
        $live_courses = auth()->user()->authored_courses()
                            ->where('published', 1)
                            ->where('approved', 1)
                            ->with('author');
        if($q){
            $live_courses = $live_courses->where('title', 'like', "%$q%");
        }   
        
        if($order=='created_at_a-z'){
            $live_courses = $live_courses->orderBy('created_at', 'asc');
        } else if($order=='created_at_z-a'){
            $live_courses = $live_courses->orderBy('created_at', 'desc');
        } else if($order=='title_a-z'){
            $live_courses = $live_courses->orderBy('title', 'asc');
        } else if($order=='title_z-a'){
            $live_courses = $live_courses->orderBy('title', 'desc');
        }
        
        $live_courses = $live_courses->get();
                            
        $draft_courses = auth()->user()->authored_courses()
                            ->whereNotIn('id', $live_courses->pluck('id'))
                            ->with('author');
        
        if($q){
            $draft_courses = $draft_courses->where('title', 'like', "%$q%");
        }   
        
        if($order=='created_at_a-z'){
            $draft_courses = $draft_courses->orderBy('created_at', 'asc');
        } else if($order=='created_at_z-a'){
            $draft_courses = $draft_courses->orderBy('created_at', 'desc');
        } else if($order=='title_a-z'){
            $draft_courses = $draft_courses->orderBy('title', 'asc');
        } else if($order=='title_z-a'){
            $draft_courses = $draft_courses->orderBy('title', 'desc');
        }
        
        $draft_courses = $draft_courses->get();
        
        $courses = [
            'live' => $live_courses,
            'draft' => $draft_courses
        ];
        
        return $courses;
    }
    
    
    public function findAuthorReviews(array $data)
    {
        $course = $data['course'];
        $rating = $data['rating'];
        $noResponse = $data['noResponse'];
        $hasComments = $data['hasComment'];
        $orderBy = $data['orderBy'];
        $page = $data['page'];
        
        
        $reviews = Review::whereHas('course', function($q) {
            $q->where('user_id', auth()->id());
        });
        
        if($course){
            $reviews = $reviews->where('course_id', $course);
        }
        
        if($rating){
            $ratings = implode(', ', array_fill(0, count($rating), '?'));
            $review = $reviews->whereRaw("ROUND(`rating`) IN ($ratings)", $rating);
        }
        
        if($noResponse){
            $reviews = $reviews->doesntHave('comments');
        }
        
        
        $reviews = $reviews->with(['course', 'user', 'comments', 'comments.user'])
                        ->orderBy('created_at', $orderBy)
                        ->paginate(15, ['*'], 'page', $page);
        
        
        return $reviews;
        
    }
    
    
}


