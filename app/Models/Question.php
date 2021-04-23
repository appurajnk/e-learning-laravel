<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    use Uuid;
    
    protected $fillable=['title', 'user_id', 'course_id', 'uuid', 'body' ];
    
    protected $appends=['short_body', 'total_answers', 'timeago'];
    
    public function getShortBodyAttribute()
    {
        return $this->body ? \Str::limit(strip_tags($this->body),100) : null;
    }
    
    public function getTotalAnswersAttribute()
    {
        return $this->comments->count();
    }
    
    public function getTimeagoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function hasBeenAnswered()
    {
        return (bool)$this->comments()->where('marked_as_answer', true)->count();
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    
}
