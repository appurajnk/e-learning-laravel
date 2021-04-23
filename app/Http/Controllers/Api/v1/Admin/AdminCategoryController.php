<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICategory;
use App\Repositories\Contracts\ICourse;

class AdminCategoryController extends Controller
{
    
    protected $categories;
    
    public function __construct(ICategory $categories)
    {
        $this->categories = $categories;
    }
    
    public function index()
    {
       $categories = $this->categories->fetchAll();
       return CategoryResource::collection($categories);  
    }
 
    public function findById($id)
    {
        $category = $this->categories->findById($id);
        return new CategoryResource($category);
    }
    
    public function store(Request $request)
    {
    
        $this->validate($request, [
            'name' => 'required|max:70|unique:categories,name'
        ]);
        $category = $this->categories->store($request->all());

        return response()->json(null, 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:70|unique:categories,name,'.$id
        ]);
        $this->categories->update($request->all(), $id); 
        return response()->json(null, 200);
    }

 
    
    public function publish($id)
    {
        $this->categories->toggleLive($id); 
    }

    public function orderCategories(Request $request)
    {
        $this->categories->orderCategories($request->all());
        $categories = $this->categories->fetchAll();
        return CategoryResource::collection($categories);  
    }

    public function destroy($id)
    {
        $this->categories->destroy($id);
        return response()->json(null, 200);
    }

      
}
