<?php

namespace App\Jobs;

use File;
use Storage;
use Carbon\Carbon;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use App\Repositories\Contracts\IContent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $video;
    protected $contents;
    
    public function __construct(Video $video, IContent $contents)
    {
        $this->video = $video;
        $this->contents = $contents;
    }

    public function handle()
    {
        $storage_location = $this->video->disk;
        $file = storage_path() . '/uploads/' . $this->video->original_filename;
        try{
            if($storage_location == 'local'){
                Storage::disk('server')->put('videos/'.$this->video->original_filename, fopen($file, 'r+'));
                // if(Storage::disk('server')->put('videos/'.$this->video->original_filename, fopen($file, 'r+'))) {
                //     File::delete($file);
                // };
            } else {
                Storage::disk($storage_location)->put($this->video->original_filename, fopen($file, 'r+'));
                // if(Storage::disk($storage_location)->put($this->video->original_filename, fopen($file, 'r+'))) {
                //     File::delete($file);
                // }
            }
            $this->updateRecord(true, [
                'streamable_sm' => $this->video->original_filename,
                'streamable_lg' => $this->video->original_filename
            ]);
            File::delete($file);
        } catch(\Exception $e){
            \Log::error($e->getMessage());
            $this->updateRecord(false);
        }
    }

    private function updateRecord($success, $data = [])
    {
        $this->contents->createVideoContent([
            'encoded' => false,
            'streamable_sm' => !empty($data) ? $data['streamable_sm'] : null,
            'streamable_lg' => !empty($data) ? $data['streamable_lg'] : null,
            'converted_for_streaming_at' => Carbon::now('UTC'),
            'processing_succeeded' => $success,
            'duration' => $this->video->lesson->duration,
            'is_processed' => true
        ], $this->video->lesson->id);
    }
}
