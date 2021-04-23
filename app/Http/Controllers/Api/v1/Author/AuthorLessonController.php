<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ILesson;
use App\Repositories\Contracts\IContent;
use App\Http\Resources\LessonResource;
use App\Events\UpdateCourseStats;

class AuthorLessonController extends Controller
{
    
    protected $lessons;
    protected $contents;
    
    public function __construct(ILesson $lessons, IContent $contents)
    {
        $this->lessons = $lessons;
        $this->contents = $contents;
    }

    public function findByCourse($id)
    {
        return $this->lessons->findByCourse($id);
    }
    
    public function findBySection($id)
    {
        return $this->lessons->findBySection($id);
    }
    
    
    public function updateDraggable(Request $request)
    {
        return $this->lessons->updateDraggable($request->all());
    }
    
    public function store(Request $request)
    {
         $this->validate($request, [
            'title' => 'required|max:70',
            'section' => 'required|numeric'
        ]);
        
        return $this->lessons->create($request->all());
    }

    public function show($id)
    {
        return new LessonResource($this->lessons->findById($id));
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
        return $this->lessons->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = $this->lessons->findById($id);
        if($lesson->content_type=='video'){
            $currentVideo = $lesson->video->original_filename;
            $this->contents->deleteVideo($currentVideo);
        }
        if($lesson->content_type=='video'){
            $this->contents->destroyVideo($lesson->video->id);
        }
        $this->lessons->destroy($id);
        event(new UpdateCourseStats($lesson->course, 'course_content_stats'));
    }
}
