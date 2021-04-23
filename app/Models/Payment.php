<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    use Uuid;
    
    protected $fillable = [
    	'user_id', 'coupon_id', 'uuid',
    	'course_id', 'payment_method', 
    	'amount','description','author_earning',
    	'affiliate_earning','payment_id', 'period_id',
    	'referred_by', 'transaction_id',
    	'status', 'refund_deadline', 'refunded_at'
    ];
    
    protected $dates=['refund_deadline', 'refunded_at'];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
 
    public function user()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }
    
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
  
}
