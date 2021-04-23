<?php

namespace App\Models;

// use Spatie\Tags\HasTags;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Methods\CourseMethods;
use Glorand\Model\Settings\Traits\HasSettingsField;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;


class Course extends Model implements ViewableContract
{
    //use Uuid, HasTags;
    use Uuid, CourseMethods, HasSettingsField, Viewable;

    public $settingsFieldName = 'settings';

    protected $removeViewsOnDelete = true;

    protected $fillable = [
    	'user_id', 
    	'category_id', 
    	'title', 
    	'subtitle', 
    	'slug', 
    	'uuid',
    	'description', 
    	'language', 
    	'image', 
    	'level',
    	'featured', 
    	'price', 
    	'published', 
        'approved',
        'settings'
    ];
    
    protected $appends=[
        'cover_image',
        'thumbnail',
        'short_description',
        'is_in_cart',
        'status_code',
        'price_discounted'
    ];

    public function scopeLive(Builder $builder)
    {
        return $builder->where('published', true)->where('approved', true);
    }

    /******* RELATIONSHIPS ************/
    public function stat()
    {
        return $this->hasOne(CourseStats::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('sortOrder');
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
    
    public function requirements()
    {
        return $this->hasMany(CourseTarget::class)
            ->where('type', 'requirement')->orderBy('sortOrder', 'asc');
    }
    
    public function target_students()
    {
        return $this->hasMany(CourseTarget::class)
            ->where('type', 'target_student')->orderBy('sortOrder', 'asc');
    }
    
    public function what_to_learn()
    {
        return $this->hasMany(CourseTarget::class)
            ->where('type', 'what_to_learn')->orderBy('sortOrder', 'asc');
    }
    
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id')->withTimestamps();
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function approvals()
    {
        return $this->morphMany(Approval::class, 'approvable');
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }
    
    

    /********* APPENDS **********************/
    public function getPriceAttribute($value)
    {
        return (float)($value);
    }
    
    public function getPriceDiscountedAttribute()
    {
        $sitewide_coupon = \Cache::remember('sitewide_coupon', 1440,  function(){ // remember for 24 hours (in minutes)
            $coupon = Coupon::active()->isSitewide()->notExpired()->first();
            return is_null($coupon) ? false : $coupon;
        });

        if($sitewide_coupon){
            $disc = $this->price - ($this->price * ($sitewide_coupon->percent/100.00));
            return $disc;
        }
        return false;
    }
    
    public function getIsInCartAttribute()
    {
        $cart = app('cart');
        if(!$cart || $cart->isEmpty()){
            return false;
        }
        
        $items = $cart->items()->pluck('product_id')->toArray();
        if(!in_array($this->id, $items)){
            return false;
        }
        return true;
    }
    
    public function getShortDescriptionAttribute()
    {
        return $this->description ? \Str::limit(strip_tags($this->description),250) : null;
    }
    
    public function getCoverImageAttribute()
    {
        if($this->image){
            if(\Storage::disk('server')->exists('images/course/'.$this->image)){
                return '/uploads/images/course/'.$this->image;
            }
            return '/uploads/images/defaults/cover.jpg';
        } else {
            return '/uploads/images/defaults/cover.jpg';
        }
    }
    
    public function getThumbnailAttribute()
    {
        if($this->image){
            if(\Storage::disk('server')->exists('images/course/thumbnails/'.$this->image)){
                return '/uploads/images/course/thumbnails/'.$this->image;
            }
            return '/uploads/images/defaults/cover.jpg';
        } else {
            return '/uploads/images/defaults/cover.jpg';
        }
    }
    
    public function getStatusCodeAttribute()
    {
        if($this->approved && $this->published){
            return 'live';
        } elseif($this->approved && !$this->published){
            return 'unpublished';
        } elseif(!$this->approved && $this->published){
            return 'under_review';
        } elseif(!$this->approved && !$this->published){
            return 'draft';
        }
    }

    public function isLive()
    {
        return $this->approved && $this->published;
    }
   
}
