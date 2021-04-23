<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use Uuid;
    
    protected $fillable=['uuid', 'start_time', 'end_time', 'payout_date', 'status'];
    
    protected $dates = [
        'start_time', 'end_time', 'payout_date'
    ];
    
    protected $appends=['start_string', 'can_be_closed', 'is_open', 'pending_payouts'];
    
    
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function refunds()
    {
        return $this->hasManyThrough(Refund::class, Payment::class);
    }
    
    public function getStartStringAttribute()
    {
        return $this->start_time->format('M Y');
    }
    
    public function getIsOpenAttribute()
    {
        return $this->status == 'open';
    }
    
    public function getPendingPayoutsAttribute()
    {
        if($this->can_be_closed || !$this->is_open){
            return $this->payouts()->where('is_processed', false)->count();
        }
        return '-';
    }
    
    public function getCanBeClosedAttribute()
    {
        $now = \Carbon\Carbon::now('UTC');
        return $this->is_open && $this->end_time <= $now;
    }
    
}
