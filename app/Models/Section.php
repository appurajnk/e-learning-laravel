<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use Uuid;
    
    protected $fillable=['uuid', 'title', 'objective', 'uuid', 'course_id', 'sortOrder'];
        
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('sortOrder');
    }
    
}
