<?php

namespace App\Http\Controllers\Api\v1\Author;

use App\Jobs\UploadVideo;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ILesson;
use App\Repositories\Contracts\IContent;
use App\Http\Resources\ContentResource;
use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForStreaming;


class AuthorContentController extends Controller
{
    
    protected $lessons;
    protected $contents;
    
    public function __construct(ILesson $lessons, IContent $contents)
    {
        $this->lessons = $lessons;
        $this->contents = $contents;
    }
    
    public function findByLesson($id)
    {
        $content = $this->contents->findByLesson($id);
        return new ContentResource($content);
    }
    
    public function uploadVideo(Request $request, $id)
    {
        $lesson = $this->lessons->find($id);
        $originalFileName = $request->file('file')->getClientOriginalName();
        $ext = $request->file('file')->extension();
        $getID3 = new \getID3;
        $file = $getID3->analyze($request->file('file'));
        $duration_in_seconds = $file['playtime_seconds'];
        if($lesson->content_type=='video' && $lesson->video->count()){
            $this->contents->deleteVideo($lesson->video->streamable_sm);
            $this->contents->deleteVideo($lesson->video->streamable_lg);
            $this->contents->destroyVideo($lesson->video->id);
        }
        $file_base = time() . '-' . substr(\Str::slug($originalFileName), 0, -3);
        $filename = $file_base .'.'.$ext;
        $path = $request->file('file')->storeAs('uploads', $filename, 'tmpStorage');
        
        $video = $this->contents->createVideoContent([
            'disk' => setting('site.video_upload_location'), // local, s3, youtube
            'original_filename' => $filename,
            'is_processed' => false,
            'duration' => $duration_in_seconds/60
        ], $id);
        
        // if job fails, remove the content
        if(setting('site.encode_videos') && (int)setting('site.encode_videos')==1 && !config('api.demo_credentials')){
            ConvertVideoForStreaming::dispatch($video, $this->contents);
        } else {
            UploadVideo::dispatch($video, $this->contents);
        }
        
        return response()->json(null, 200);
        
    }
    
    public function store(Request $request)
    {

        if($request->type=='youtube'){
            $this->validate($request, [
                'url' => 'required|url|youtube',
                'duration' => 'required|numeric|min:1'
            ]);
            
            return $this->contents->createYoutube($request->all());
        }
        
        // store article
        $this->validate($request, [
            'content' => 'required|string',
        ]);
        
        return $this->contents->updateArticle($request->all());
        
    }

    public function uploadAttachments(Request $request)
    {

        $file = $request->file('file');
        $extension = $file->extension();
        $original_filename = $file->getClientOriginalName();
        $filename = time() . '_' . $original_filename;


        if($path = $file->storeAs('attachments', $filename, 'server')){ // folder, filename, disk
            $attachment = $this->lessons->addAttachment([
                'lesson_id' => $request->id,
                'file_name' => $filename,
                'original_filename' => $original_filename,
                'extension' => $extension
            ]);
            return response()->json($attachment, 200);
        } else {
            return response()->json(['message' => 'Unable to upload file'], 422);
        }
    }

}
