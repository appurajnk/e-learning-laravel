<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class CourseTarget extends Model
{
    use Uuid;
    
    protected $fillable=['course_id', 'uuid', 'type', 'text', 'sortOrder'];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
