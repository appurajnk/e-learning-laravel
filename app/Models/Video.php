<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use Uuid;

    protected $fillable = [
        'uuid',
        'lesson_id',
        'is_processed',
        'encoded',
        'disk',
        'streamable_sm',
        'streamable_lg',
        'converted_for_streaming_at',
        'original_filename',
        'youtube_link',
        'processing_succeeded'
    ];
    
    protected $dates = ['converted_for_streaming_at'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
