<?php

namespace App\Http\Controllers\Api\v1\General;

use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICart;
use App\Repositories\Contracts\ICoupon;
use App\Repositories\Contracts\ICourse;
use App\Http\Resources\CourseResource;

class CartController extends Controller
{
    
    protected $carts;
    protected $coupons;
    protected $courses;

    public function __construct(ICart $carts, ICoupon $coupons, ICourse $courses)
    {
        $this->carts = $carts;
        $this->coupons = $coupons;
        $this->courses = $courses;
    }

    public function fetchCartItems(Request $request)
    {
        $data = $this->carts->fetchItems();
        return $data;
    }

    public function addToCart(Request $request)
    {
        return $this->carts->addToCart($request->all());
    }
    
    // move a single course from BuyNow to cart
    public function moveToCart($uuid)
    {
        $course = $this->courses->findByUuid($uuid);
        $this->carts->emptyCart();
        $this->carts->addToCart([
            'id' => $course->id,
            'price' => $course->price
        ]);
    }
    
    public function remove(Request $request)
    {
        $this->carts->remove($request->all());
        
        return response()->json(null, 200);
    }
    
    public function applyCoupon(Request $request)
    {
        $this->validate($request, [
            'code' => 'required'
        ]);
        
        return $this->coupons->apply($request->all());
    }
    
    public function checkIfCourseIsInCart($id)
    {
        $res = $this->carts->checkIfCourseIsInCart($id);
        return response()->json($res, 200);
    }
    
    public function removeCoupon(Request $request)
    {
        return $this->coupons->removeCoupon($request->itemId);
    }
    
    public function switchToWishlist(Request $request, $id)
    {
        $this->carts->switchToWishlist($id);
    }

    public function switchToSaveForLater($id)
    {
        $this->carts->switchToSaveForLater($id);
    }
    
    public function switchToCart($id)
    {
        $this->carts->switchToCart($id);
    }
    
    
    public function EnrollNow(Request $request)
    {
        $this->carts->enrollNow($request->all());
    }
}
