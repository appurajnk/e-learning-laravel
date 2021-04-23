<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable=[
        'enabled',
        'name',
        'code', 
        'symbol',
        'is_primary', 
        'conversion_rate',
        'space_between',
        'symbol_position'
    ];

    protected $appends=[
        'formatted_sample'
    ];

    public function getFormattedSampleAttribute()
    {

        $rtn_val = 10.99;
        if($this->space_between){
            if($this->symbol_position == 'left'){
                $rtn_val = $this->symbol . ' ' . $rtn_val;
            } else {
                $rtn_val = $rtn_val . ' ' . $this->symbol;
            }
        } else {
            if($this->symbol_position == 'left'){
                $rtn_val = $this->symbol . $rtn_val;
            } else {
                $rtn_val = $rtn_val . $this->symbol;
            }
        }

        return $rtn_val;


    }


}
