<?php

namespace App\Jobs;

use File;
use FFMpeg;
use Carbon\Carbon;
use App\Models\Video;
use App\Models\Content;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\Contracts\IContent;

class ConvertVideoForStreaming implements ShouldQueue
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

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $disk = $this->video->disk == 'local' ? 'server' : $this->video->disk; // either local server or s3 or other cloud;
        $tmp_file = storage_path() . '/uploads/' . $this->video->original_filename;
        $tmp_disk = 'tmpVideo';
        // create a video format...
        $lowBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500);
        $converted_name = $this->getCleanFileName($this->video->original_filename);

        try{
            $hd = setting('site.video_hd_dimension') ?? '1280, 720';
            $sd = setting('site.video_sd_dimension') ?? '640, 360'; // NULL coalesce

            // MP4
            FFMpeg::fromDisk($tmp_disk)
                ->open($this->video->original_filename)
                ->addFilter(function ($filters) {
                    $filters->resize(new Dimension($hd));
                })
                ->export()
                ->toDisk($disk)
                ->inFormat($lowBitrateFormat)
                ->save('videos/720_'.$converted_name)
                ->addFilter(function ($filters) {
                    $filters->resize(new Dimension($sd));
                })
                ->export()
                ->toDisk($disk)
                ->inFormat($lowBitrateFormat)
                ->save('videos/360_'.$converted_name);
                
                // ->getFrameFromSeconds(10)
                // ->export()
                // ->toDisk($disk)
                // ->save('FrameAt10sec.png');
                
            
            $this->updateRecord(true, [
                'streamable_sm' => '360_' . $converted_name,
                'streamable_lg' => '720_' . $converted_name,
            ]);
            File::delete($tmp_file);
        } catch(\Exception $e){
            \Log::error($e->getMessage());
            $this->updateRecord(false);
        }
        
    }


    private function getCleanFileName($filename, $extension='.mp4'){
        return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename) . $extension;
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
