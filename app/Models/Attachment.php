<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuid;

class Attachment extends Model
{
    use Uuid;

    protected $fillable=[
        'uuid',
        'lesson_id',
        'file_name',
        'original_filename',
        'extension'
    ];

    protected $appends = ['download_link'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function getDownloadLinkAttribute()
    {
        $file = \Storage::disk('attachments_disk')->url($this->file_name);
        return $file;
    }
}
