<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use Uuid;
    protected $fillable=['course_id', 'uuid', 'code', 'percent', 'quantity', 'expires', 'active', 'sitewide'];
    
    protected $dates = [
        'expires'
    ];
    
    function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    
    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }
    
    public function getPurchasePrice($total)
    {
        $discount = $total - round(($this->percent / 100) * $total);
        
        return $discount < 0 ? 0 : $discount;
    }
    
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    
    public function scopeIsSitewide($query)
    {
        return $query->where('sitewide', 1);
    }
    
    public function scopeNotExpired($query)
    {
        return $query->whereNotNull('expires')->where('expires', '>=', \Carbon\Carbon::now());
    }
   
    
}
