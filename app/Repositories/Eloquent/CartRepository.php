<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Coupon;
use App\Repositories\Contracts\ICart;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\CourseResource;


class CartRepository extends RepositoryAbstract implements ICart
{
    
    protected $courses;
    public function __construct(ICourse $courses)
    {
        $this->courses = $courses;
    }
    
    public function entity()
    {
        return Cart::class;
    }
    
    public function addToCart(array $data)
    {
        $cart = app('cart');
        if($cart->hasItem($data['id'])){
            return;
        }
        
        $cart->addItem([
            'product_id' => $data['id'],
            'unit_price' => $data['price'],
            'quantity' => 1
        ]);
        
    }
    
    public function fetchItems()
    {
        
        $cart = app('cart');
        $items = $cart->items()->with(['product', 'product.author', 'coupon'])->get();
        $sitewideCoupon = Coupon::active()->isSitewide()->notExpired()->first();
        
        $data = [
            'cart' => $cart,
            'items' => $items,
            'sitewideCoupon' => $sitewideCoupon
        ];
        
        
        return $data;
    }
    
    public function remove(array $data)
    {
        $cart = app('cart');
        $cart->removeItem(['product_id' => $data['id']]);
    }
    
    public function emptyCart()
    {
        $cart = app('cart');
        
        if(!$cart->isEmpty()){
            $cart->clear();
        }
        
    }
    
    public function enrollNow(array $data)
    {
        $cart = app('cart');
        $courses = $this->courses->findWhereIn('uuid', $data['courses']);
        foreach($courses as $course){
            $course->students()->attach(auth()->id());
            if($cart->hasItem(['id' => $course->id])){
                $cart->removeItem(['product_id' => $course->id]); 
            }
        }
    }
    
    public function checkIfCourseIsInCart($course_id)
    {
        $cart = app('cart');
        return $cart->hasItem(['id' => $course_id]);
    }
    
    public function switchToSaveForLater($id)
    {
        
            
    }
    
    public function switchToWishlist($id)
    {
        
    }
    
    public function switchToCart($id)
    {
        
    }
    
    
    
}