<?php


namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren
{
    
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
    
    public function scopeIsChild(Builder $builder)
    {
        $builder->whereNotNull('parent_id');
    }
    
    
    public function hasChildren()
    {
        return (bool)$this->children->count();
    }
}