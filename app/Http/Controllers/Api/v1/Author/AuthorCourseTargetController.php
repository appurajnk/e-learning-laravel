<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourseTarget;
use App\Http\Resources\CourseTargetResource;

class AuthorCourseTargetController extends Controller
{
    
    protected $targets;
    
    public function __construct(ICourseTarget $targets)
    {
        $this->targets = $targets;
    }
    
    
    public function store(Request $request, $id)
    {
        
        
        $this->validate($request, [
            'requirement.items.*.text' => 'required|string|max:140',
            'what_to_learn.items.*.text' => 'required|string|max:140',
            'target_student.items.*.text' => 'required|string|max:140'
        ],
        [],
        [
            'requirement.items.*.text' => 'requirements',
            'what_to_learn.items.*.text' => 'learning goal',
            'target_student.items.*.text' => 'target student'
        ]);
        
        $this->targets->createOrUpdate($request->all(), $id);
        
        return response()->json(null, 200);
    }
    
    public function fetchCourseRequirements($id){
        $requirements = $this->targets->fetchCourseRequirements($id);
        return CourseTargetResource::collection($requirements);    
    }
    
    
    public function destroy($id)
    {
        $this->targets->destroy($id);
    }
    
    public function updateDraggable(Request $request)
    {
        return $this->targets->updateDraggable($request->all());
    }
    
    
    
}
