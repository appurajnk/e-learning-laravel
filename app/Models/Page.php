<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Traits\Uuid;

class Page extends Model
{

    use HasTranslations, Uuid;

    public $translatable = ['title', 'body'];


    protected $fillable = [
        'title', 'uuid', 'body', 'slug', 'published', 'published_at', 'featured_image',
        'meta_description', 'featured'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at'
    ];

    protected $appends = ['image', 'langs'];

    public function getLangsAttribute()
    {
        return $this->getTranslatedLocales('title');
    }

    public function getImageAttribute()
    {
        if($this->featured_image) {
            return '/uploads/images/pages/'. $this->featured_image; 
        } else {
            return null;
        }
    }


}
