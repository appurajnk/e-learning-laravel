<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CourseResource;

class AuthorCourseController extends Controller
{
    
    protected $imageManager;
    protected $courses;
    protected $images;
    
    public function __construct(ImageManager $imageManager, ICourse $courses, ImageManager $images)
    {
        $this->imageManager = $imageManager;
        $this->courses = $courses;
        $this->images = $images;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            'title' => 'required|max:70|unique:courses',
            'subtitle' => 'required|max:75',
            'category' => 'required'
        ]);
        $course = $this->courses->create($request->all());
        return $course;
    }
    
    public function findByUuid($uuid)
    {
        $course = $this->courses->findByUuid($uuid);
        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
            'title' => 'required|max:70|unique:courses,title,'.$id,
            'subtitle' => 'required|max:75',
            'category' => 'required',
            'description' => 'required|string',
            'language' => 'required',
            'level' => 'required'
        ]);
        
        $course = $this->courses->update($request->all(), $id);
    }
    
    public function updatePrice(Request $request, $id)
    {
        return $this->courses->updatePrice($request->all(), $id);
        
    }
    
    public function uploadCoverImage(Request $request, $id)
    {

        $course = $this->courses->find($id);
        $oldImage = $course->image;
        $filename = uniqid(true).'.png';
        $processedImage = $this->imageManager->make($request->file('photo')->getPathName())
            ->fit(750, 422, function ($c) {
                $c->aspectRatio();
            })->encode('png')
            ->save(public_path('uploads/images/course/' . $filename));
    
        $thumbnailImage = $this->imageManager->make($request->file('photo')->getPathName())
            ->fit(250, 140, function ($c) {
                $c->aspectRatio();
            })->encode('png')
            ->save(public_path('uploads/images/course/thumbnails/' . $filename));
        
        $this->courses->updateCourseImage($filename, $id);
        
        if(!is_null($oldImage)){
            if(Storage::disk('server')->exists('images/course/'.$oldImage)){
                Storage::disk('server')->delete('images/course/'.$oldImage);
            }
            if(Storage::disk('server')->exists('images/course/thumbnails/'.$oldImage)){
                Storage::disk('server')->delete('images/course/thumbnails/'.$oldImage);
            }
        }
        
        $path = '/uploads/images/course/'.$filename; 
       
        return response()->json(['url'=> $path ], 200);
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
    
    public function submitForReview($uuid)
    {
        // check course if all lessons have contents
        $send = $this->courses->submitForReview($uuid);
        return response()->json($send, 200);
        
    }

    public function getAttachments(Request $request)
    {
        return $this->courses->getAttachments($request->id);
    }

    public function deleteAttachment($id)
    {
        $this->courses->deleteAttachment($id);
    }
    
    
    protected function formatImage($file)
    {
        return (string) $this->images->make($file->path())
                        ->fit(1920, 1080, function ($c) {
                            $c->aspectRatio();
                        })->encode();
    }




}
