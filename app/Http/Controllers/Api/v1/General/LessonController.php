<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ILesson;
use App\Repositories\Contracts\IContent;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\SectionResource;

class LessonController extends Controller
{
    protected $courses;
    protected $lessons;
    protected $contents;

    public function __construct(ILesson $lessons, IContent $contents, ICourse $courses)
    {
        $this->courses = $courses;
        $this->lessons = $lessons;
        $this->contents = $contents;
    }

    public function findByUuid($uuid)
    {
        return $this->lessons->findByUuid($uuid);
    }
    
    public function toggleComplete($id)
    {
        return $this->lessons->markAsComplete($id);
    }
    
    public function updateDuration(Request $request, $id)
    {
        return $this->contents->updateDuration($id, $request->duration);
    }

    public function play($uuid)
    {
        $data = $this->lessons->findByUuid($uuid);

        return response()->json([
            'sections' => SectionResource::collection($data['sections']),
            'course' => new CourseResource($data['course']),
            'playing' => new LessonResource($data['playing']),
            'next' => $data['next'] ? new LessonResource($data['next']) : null,
            'previous' => $data['previous'] ? new LessonResource($data['previous']) : null
        ], 200);
        
    }

}
