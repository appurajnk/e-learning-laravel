<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IUserDashboard;

class UserDashboardRepository  extends RepositoryAbstract implements IUserDashboard
{
    public function entity()
    {
        return Course::class;
    }
    
    public function findUserCourseCategories()
    {
        $user_course_categories = auth()->user()->enrollments->pluck('category_id');
        $categories = Category::whereIn('id', $user_course_categories)->orderBy('name')->get();
        return $categories;
    }
    
    public function findUserCourses(array $data)
    {
        $q = $data['query'];
        $page = $data['pageNumber'];
        $category = $data['category'];
        $order = $data['orderBy'];

        $courses = auth()->user()->enrollments()
                        ->with('author');
        
        if($q){
            $courses = $courses->where('title', 'like', "%$q%");
        }
        
        if($category){
            $courses = $courses->where('category_id', $category);
        }
        
        
        
        if($order=='earliest_enrolled'){
            $courses = $courses->orderBy('enrollments.created_at', 'asc');
        } else if($order=='title_asc'){
            $courses = $courses->orderBy('title', 'asc');
        } else if($order=='title_desc'){
            $courses = $courses->orderBy('title', 'desc');
        } else {
            $courses = $courses->orderBy('enrollments.created_at', 'desc');
        }
        
        $courses = $courses->paginate(24);

        return $courses;
    }

    public function fetchPurchaseHistory(array $data)
    {
        $purchases = auth()->user()->purchases()
                        ->whereNull('refunded_at')
                        ->with('course', 'transaction', 'coupon')
                        ->orderBy($data['sort'], $data['direction'])
                        ->paginate($data['limit']);
            
        return $purchases;
    }
    
    

}


