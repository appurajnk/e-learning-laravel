<?php

namespace App\Models;

use Hassansin\DBCart\Models\CartLine as BaseCartLine;

class CartLine extends BaseCartLine
{
    
    protected $appends=[
        'has_discount'    
    ];
    
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);    
    }
    
    
    /*
    * Get Item discount price
    *
    * @return float
    */
    public function getPurchasePrice(){
        return $this->quantity * $this->purchase_price;
    }
    
    public function getHasDiscountAttribute()
    {
        return (bool)((float)$this->unit_price > (float)$this->purchase_price);
    }
    
    public static function boot()
	{
	    parent::boot();
	    
	    // when an item is initially being created
		static::creating(function ($line) {
            $line->purchase_price = $line->unit_price;
        });
        
        //when an item is created
        static::created(function(CartLine $line){
            $cart = $line->getCartInstance() ?: $line->cart;  
            $cart->total_purchase_price = $cart->total_purchase_price + $line->getPurchasePrice();
            $cart->save();
        });
        
        //when an item is updated
        static::updated(function(CartLine $line){
            $cart = $line->getCartInstance() ?: $line->cart; 
            $cart->total_purchase_price = $cart->items()->sum('purchase_price');
            $cart->save();
        });
        
        //when item deleted
        static::deleted(function(CartLine $line){            
            $cart = $line->getCartInstance() ?: $line->cart;  
            $cart->total_purchase_price = $cart->total_purchase_price - $line->getPurchasePrice();
            $cart->save();
        });
        
        
	}
	
}
