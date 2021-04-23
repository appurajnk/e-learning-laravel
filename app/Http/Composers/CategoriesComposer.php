<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Repositories\Eloquent\CategoryRepository;
use App\Http\Resources\CategoryResource;

class CategoriesComposer
{
    protected $categories;
    
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }
    
    
    public function compose(View $view)
    {
       // $categories = $this->categories->fetchAllWithCourses();
        
        $categories = \Cache::rememberForever('categories', function () {
                            return $this->categories->fetchAllWithCourses();
                        });
                        
        $view->with('gcategories', CategoryResource::collection($categories));
    }
    
}