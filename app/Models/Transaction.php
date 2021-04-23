<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Uuid;
    protected $fillable = [
        'uuid', 'user_id', 'type', 'description', 'long_description', 'amount'    
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
