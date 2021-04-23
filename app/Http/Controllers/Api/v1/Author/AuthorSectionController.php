<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ISection;
use App\Http\Resources\SectionResource;

class AuthorSectionController extends Controller
{
    
    protected $sections;
    
    public function __construct(ISection $sections)
    {
        $this->sections = $sections;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function findByCourse(Request $request)
    {
        return SectionResource::collection($this->sections->findByCourse($request->id));
    }
    
    public function updateDraggable(Request $request)
    {
   
        return $this->sections->updateDraggable($request->all());
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:70',
            'objective' => 'nullable|string|max:140'
        ]);
        
        return $this->sections->create($request->all());
        
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
        $this->validate($request, [
            'title' => 'required|max:70',
            'objective' => 'nullable|string|max:140'
        ]);
        
        return $this->sections->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sections->destroy($id);
        
    }
}
