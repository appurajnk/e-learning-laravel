<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use Uuid;

    protected $fillable=['title', 'user_id', 'body', 'slug', 'type', 'status'];
    
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
