<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use App\Models\Traits\HasChildren;
use App\Models\Traits\IsOrderable;
use App\Models\Traits\HasLive;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasChildren, IsOrderable, HasLive, Uuid;
    
    protected $fillable=[
        'name', 'uuid', 'slug', 'image', 'live', 'parent_id', 'sortOrder'
    ];
    
    
    public function parent()
    {
        return $this->hasOne( Category::class, 'id', 'parent_id' );
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function child_courses()
    {
        return $this->hasManyThrough(Course::class, Category::class, 'parent_id', 'category_id', 'id', 'id');
    }
    
    
}
