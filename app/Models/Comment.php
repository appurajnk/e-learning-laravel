<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Uuid;
    
    protected $fillable = [
        'uuid',
        'commentable_id', 
        'commentable_type', 
        'body', 
        'user_id', 
        'parent_id', 
        'marked_as_answer'
    ];
    
    protected $appends=['timeago'];
    
    public function getTimeagoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    
    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
    
}
