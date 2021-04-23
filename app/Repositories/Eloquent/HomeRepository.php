<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use App\Models\Category;
use App\Repositories\Contracts\IHome;
use CyrildeWit\EloquentViewable\Support\Period;



class HomeRepository extends RepositoryAbstract implements IHome
{
    
    
    public function entity()
    {
        return Course::class;
    }


    public function getMostViewedCourses()
    {
        $courses = Course::live()->with('author', 'what_to_learn')->orderByViews('desc', Period::pastMonths(2))->take(10)->get();
        if(count($courses) < 10){
            $builder = (new Course)->newQuery();
            $builder->live();

            if(count($courses) > 0){
                $builder->whereNotIn('courses.id', $courses->pluck('id'));
            }
            $builder->orderByJoin('reviews.rating', 'desc', 'AVG');
            $most_rated = $builder->with('author', 'what_to_learn')->take(11 - count($courses))->get();
            $courses = $courses->union($most_rated);
        }
        
        return $courses;
    }

    public function getTopCategories($type='parent')
    {
        
        if($type == 'subcategory'){
            $categories = Category::join('courses as c', 'c.category_id', '=', 'categories.id')
                            ->leftJoin('reviews as r', 'c.id', '=', 'r.course_id')
                            ->groupBy('categories.id')
                            ->havingRaw('COUNT(c.id) > 0')
                            ->orderBy('ratings', 'desc')
                            ->orderBy('total_courses', 'desc')
                            ->select('categories.*', \DB::raw('AVG(rating) as ratings'), \DB::raw('COUNT(c.id) as total_courses'))
                            ->take(8)
                            ->get();
        } else {
            $categories = \DB::table('categories as c1')
                            ->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
                            ->join('courses as c', 'c.category_id', '=', 'c2.id')
                            ->leftJoin('reviews as r', 'c.id', '=', 'r.course_id')
                            ->groupBy('c1.id')
                            ->havingRaw('COUNT(c.id) > 3')
                            ->orderBy('ratings', 'desc')
                            ->orderBy('total_courses', 'desc')
                            ->select('c1.*', \DB::raw('AVG(rating) as ratings'), \DB::raw('COUNT(c.id) as total_courses'))
                            ->take(5)
                            ->get();
        }
        
        return $categories;
    }

    public function getCategoryCourses($id)
    {
        $category = Category::find($id);
        $courses = $category->child_courses()
                            ->live()
                            ->with('author', 'what_to_learn')
                            ->orderByJoin('reviews.rating', 'desc', 'AVG')
                            ->take(5)
                            ->get();
        return $courses;
    }
    
    
    
}