<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    
    use Uuid;
    
    protected $fillable=[
        'user_id',
        'period_id',
        'net_earnings',
        'total_author_earnings',
        'total_refunds',
        'payout_batch_id',
        'payout_batch_status',
        'gateway',
        'payment_address',
        'is_processed',
        'processed_at',
        'comment',
        'uuid'
    ];
    
    protected $appends=['expected_payout_date'];
    
    protected $dates=['processed_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function period()
    {
        return $this->belongsTo(Period::class);
    }
    
    public function getExpectedPayoutDateAttribute()
    {
        return $this->period->payout_date;
    }
    
}
