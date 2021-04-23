<?php

namespace App\Models;

use Hassansin\DBCart\Models\Cart as BaseCart;

class Cart extends BaseCart
{
   
    protected $appends=['has_discount'];   
   
    public function hasItem($id)
    {
        return !is_null($this->items()->where('product_id', $id)->first()); 
    }
    
    public function getHasDiscountAttribute()
    {
        return (bool)((float)$this->total_price > (float)$this->total_purchase_price);
    }
    
    public static function boot()
	{
	    parent::boot();
		static::creating(function ($cart) {
            //$cart->total_purchase_price = $cart->total_price;
        });
	}
	
	
	/**
     * Move Items to another cart instance
     *
     * @param Cart $cart
     */
    public function moveItemsTo(BaseCart $cart){
        $current_items = $cart->items()->pluck('product_id');
        $items_to_update = $this->items()->whereNotIn('product_id', $current_items);
        $items_to_update->update([
           'cart_id' => $cart->id 
        ]);
        
        $cart->item_count = $cart->items()->sum('quantity');
        $cart->total_price = $cart->items()->sum('unit_price');
        $cart->total_purchase_price = $cart->items()->sum('purchase_price');
        $cart->save();
        
        if($this->items){
            $this->items()->delete();
        }
        $this->item_count = 0;
        $this->total_price = 0;
        $this->total_purchase_price = 0;
        return $this->save();
    }
    
    /**
     * Empties a cart
     *
     */
    public function clear(){
        $this->items()->delete();
        $this->updateTimestamps();
        $this->total_price = 0;
        $this->item_count = 0;
        $this->total_purchase_price = 0;
        $this->relations = [];
        return $this->save();  
        
    }
}
