<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        
        return [
            'id' => $this->id,
            'code' => $this->code,
            //'expires' => $this->expires ? $this->expires->format('m/d/Y') : null,
            'expires' => $this->expires ? date("Y-m-d",strtotime($this->expires)) : null,
            'quantity' => $this->quantity,
            'created' => date("Y-m-d",strtotime($this->created_at)),
            'finalPrice' => $this->course ? round($this->course->price - (($this->percent/100)*$this->course->price), 2):null,
            'link' => url('/') . '/coupons?COUPON='.$this->code,
            'totalUsed' => 0,
            'exhausted' => false,
            'remaining' => 1,
            'active' => $this->active ? true : false,
            
            //$c->totalUsed = $c->payments->count(); 
            //$c->exhausted = $c->payments->count() >= $c->quantity ? true:false;
            

        ];
    }
}
