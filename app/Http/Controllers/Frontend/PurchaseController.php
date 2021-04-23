<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ICourse;
use App\Repositories\Contracts\ICart;
use App\Repositories\Contracts\ICoupon;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    
    protected $courses;
    protected $carts;
    protected $coupons;

    public function __construct(ICourse $courses, ICart $carts, ICoupon $coupons)
    {
        $this->courses = $courses;
        $this->carts = $carts;
        $this->coupons = $coupons;
    }
    
    public function buyNow($course)
    {
        $course = $this->courses->findByUuid($course);
        // empty current user's cart and move to wishlist
        $this->carts->emptyCart();
        
        // insert the current item in the shopping cart
        $this->carts->addToCart([
            'id' => $course->id,
            'price' => $course->price
        ]);
        
        // apply any global coupon to cart
        $sitewideCoupon = $this->coupons->getSitewideCoupon();
        if($sitewideCoupon){
            $cart = app('cart');
            $this->coupons->apply([
                'cart' => $cart->id,
                'code' => $sitewideCoupon->code
            ]);
        }

        return view('frontend.cart.CartCheckout');
    }
    
    
}
