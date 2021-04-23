<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICategory;

class CategoryController extends Controller
{
    
    protected $categories;
    
    public function __construct(ICategory $categories)
    {
        $this->categories = $categories;    
    }
    
    public function index($category, $subcategory=null)
    {
        if($subcategory){
            $subcategory = $this->categories->findBySlug($subcategory);
            if(!$subcategory){
                return redirect()->route('frontend.category', ['category' => $category]);
            }
        }
        $category = $this->categories->findBySlug($category);

        if(!$category){
            return redirect()->route('frontend.404');
        }
        
        return view('frontend.courses.Category', compact('category', 'subcategory'));
    }
    
}
