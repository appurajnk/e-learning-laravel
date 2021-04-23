<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use Uuid;
    
    protected $fillable=[
        'uuid',
        'amount',
        'refunded_to',
        'requester_id',
        'payment_id',
        'transaction_id',
        'course_id',
        'comment',
        'status',
        'processed_at',
        'notes'
    ];
    
    protected $dates=['processed_at'];
    
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
    
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    
    
}
