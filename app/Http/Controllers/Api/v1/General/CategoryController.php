<?php

namespace App\Http\Controllers\Api\v1\General;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICategory;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    
    protected $categories;

    public function __construct(ICategory $categories)
    {
        $this->categories = $categories;
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->categories->fetchAll();
    }
    
    
    public function findBySlug($slug)
    {
        $category = $this->categories->findBySlug($slug);
        if($category){
            return new CategoryResource($category);
        } else {
            return response()->json(null, 404);
        }
            
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
