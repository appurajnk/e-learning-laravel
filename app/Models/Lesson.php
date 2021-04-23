<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lesson extends Model
{
    use Uuid;
    
    protected $fillable = [
        'section_id', 
        'course_id',
        'title', 
        'content_type', 
        'uuid',
        'duration',
        'article_body',
        'description', 
        'preview', 
        'sortOrder'
    ];
    
    protected $appends=[ 
                            'durationHMS', 
                            'video_provider', 
                            'video_link', 
                            'minutes_seconds', 
                            'image',
                            'user_has_completed',
                            'video_links'
                        ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
    public function video()
    {
        return $this->hasOne(Video::class);
    }

    public function completions()
    {
        return $this->belongsToMany(User::class, 'completions', 'lesson_id', 'user_id')->withTimestamps();
    }
    

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    /********* SCOPE  ************************/
    public function scopeHasContent(Builder $builder)
    {
        return $builder->where(function($i) {
                $i->orWhere(function($j){
                    $j->where('content_type', 'article')
                        ->whereNotNull('article_body');
                })
                ->orWhere(function($k){
                    $k->where('content_type', 'video')
                        ->whereHas('video', function($l){
                            $l->whereNotNull('streamable_sm')
                                ->where('is_processed', 1)
                                ->where('processing_succeeded', 1);
                        });
                })
                ->orWhere(function($m){
                    $m->where('content_type', 'youtube')
                        ->whereHas('video', function($n){
                            $n->whereNotNull('youtube_link');
                        });
                });
            });
    }

    public function scopeHasNoContent(Builder $builder)
    {
        return $builder->where(function($i) {
                $i->orWhere(function($j){
                    $j->where('content_type', 'article')
                        ->whereNull('article_body');
                })
                ->orWhere(function($x) {
                    $x->whereIn('content_type', ['video', 'youtube'])
                        ->doesntHave('video');
                })
                ->orWhere(function($k){
                    $k->where('content_type', 'video')
                        ->whereHas('video', function($l){
                            $l->whereNull('streamable_sm')
                                ->orWhere('is_processed', false)
                                ->orWhere('processing_succeeded', false);
                        });
                })
                ->orWhere(function($m){
                    $m->where('content_type', 'youtube')
                        ->whereHas('video', function($n){
                            $n->whereNull('youtube_link');
                        });
                });
            });
    }

    
    /*********** APPENDS ****************************/
    public function getVideoLinksAttribute()
    {
        if(($this->content_type == 'video' || $this->content_type == 'youtube') && $this->video)
        {
            $disk = $this->video->disk == 'local' ? 'stream' : $this->video->disk;
            $file_sm = $this->content_type = 'video' && $this->video->streamable_sm ? \Storage::disk($disk)->url($this->video->streamable_sm) : $this->video->youtube_link;
            $file_lg = $this->content_type = 'video' && $this->video->streamable_lg ? \Storage::disk($disk)->url($this->video->streamable_lg) : $this->video->youtube_link;
            
            return [
                'video_720' => $file_lg,
                'video_360' => $file_sm
            ];
        }
        return null;
        
    }

    public function getUserHasCompletedAttribute()
    {
        if(! auth()->check()){
            return false;
        }    
        
        return auth()->user()->hasCompletedLesson($this);
    }
    
    
    public function getDurationHMSAttribute()
    {
        
        if($this->duration){
            return convert_minutes_to_duration($this->duration);
        }
        
        return '00:00:00';
        
    }
    
    public function getVideoProviderAttribute()
    {
        
        if($this->content_type == 'video'){
            return 'mp4';
        }elseif($this->content_type == 'youtube'){
            return 'youtube';
        } else {
            return null;
        }
        
    }
    
    public function getImageAttribute()
    {
        return $this->section->course->cover_image;
    }
    
    public function getVideoLinkAttribute()
    {
        if($this->content_type == 'video' && $this->video){
            return $this->video->streamable_sm;
        } elseif($this->content_type == 'youtube' && $this->video){
            return $this->video->youtube_link;
        } else {
            return null;
        }
    }
    
    public function getMinutesSecondsAttribute()
    {
        return gmdate("H:i:s", ($this->duration*60));
    }
    
    
    
}

