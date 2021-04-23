<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use Uuid;
    
    protected $fillable=['uuid', 'user_id', 'rating', 'course_id', 'title', 'body'];
    
    protected $appends=['timeago'];
    
    public function getTimeagoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    public function comments()
    {
        return $this->morphOne(Comment::class, 'commentable');
    }
    
}
