<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\CartLine;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ICoupon;
use App\Http\Resources\CourseResource;

class CouponRepository  extends RepositoryAbstract implements ICoupon
{
    
    
    public function entity()
    {
        return Coupon::class;
    }
    
    
    public function create(array $data)
    {
        $coupon = Coupon::create([
           'course_id' => $data['course'],
           'code' => strToUpper($data['code']),
           'percent' => +$data['percent'],
           'quantity' => $data['quantity'],
           'expires' => $data['expires'] ? date("Y-m-d",strtotime($data['expires'])) : null,
           'active' => true,
           'sitewide' => $data['sitewide']
        ]);

        if(!$data['course']){
            \Cache::forget('sitewide_coupon');
        }
        return $coupon;
    }
    
    public function activate($id)
    {
        $coupon = $this->find($id);
        $coupon->active = ! $coupon->active;
        $coupon->save();

        if(!$coupon->course_id){
            \Cache::forget('sitewide_coupon');
        }
        
        return $coupon;
    }
    
    public function findByCourse(array $data, $id)
    {
        $coupons = Coupon::where('course_id', $id)
                    ->orderBy($data['sort'], $data['direction']);
                    
        if($data['query']){
            $coupons = $coupons->where('code', 'LIKE', '%'.$data['query'].'%');
        }
        
        $coupons = $coupons->paginate($data['limit']);
    
        return $coupons;
    }
    
    public function getSitewideCoupon()
    {
        $sitewideCoupon = Coupon::active()->isSitewide()->notExpired()->first();
        return $sitewideCoupon;
    }
    
    public function apply(array $data)
    {
        $cart = Cart::find($data['cart']);
        $items = $cart->items;
        $code = strToUpper($data['code']);
        $courseIds = $items->pluck('product_id');
        
        // check if code has not expired or is not exhausted
        $coupon = $this->verifyCoupon($code, $courseIds);
        
        if( in_array($coupon, array('expired', 'invalid', 'exhausted')) ) {
            return response()->json(['message' => $coupon], 422);
        }
        
        // check if code is valid for each of the courses
        foreach($items as $item){
            if($this->couponIsValidForCourse($coupon->code, $item->product_id)){
                $item->coupon_id = $coupon->id;
                $item->purchase_price = $coupon->getPurchasePrice($item->unit_price);
                $item->save();
            }
        }
        
    }

    
    public function removeCoupon($itemId)
    {
     
        $item = CartLine::find($itemId);
        $item->coupon_id = null;
        $item->purchase_price = $item->unit_price;
        $item->save();
        
    }
    
    
    /* @TODO: Update exhausted */
    protected function verifyCoupon($code, $courseIds)
    {
        $coupon = Coupon::where('code', $code)
            ->where(function($q) use ($courseIds) {
                $q->whereIn('course_id', $courseIds)
                  ->orWhere('sitewide', true);
            })->first();
            
        if(!$coupon || ($coupon && !$coupon->active)){
            return 'invalid';
        }
        
        $quantity = $coupon->quantity;
        $totalUsed = $coupon->payments->count(); 
        
        $now = \Carbon\Carbon::now();
        
        if( !is_null($coupon->expires) && $coupon->expires < $now ){
            return 'expired';
        }
        
        if( $totalUsed >= $quantity){
            return 'exhausted';
        }
        return $coupon;
    }
    
    protected function couponIsValidForCourse($code, $courseId)
    {
        $coupon = Coupon::where('code', $code)
            ->where(function($q) use ($courseId) {
                $q->where('course_id', $courseId)
                  ->orWhere('sitewide', true);
            })->first();
            
        return collect($coupon)->isNotEmpty();
    }
    
    
    /********** ADMIN *************/
    public function getAdminCoupons(array $data)
    {
        
        $coupons = Coupon::where('sitewide', true)
                    ->orderBy($data['sort'], $data['direction']);
                    
        if($data['query']){
            $coupons = $coupons->where('code', 'LIKE', '%'.$data['query'].'%');
        }
        
        $coupons = $coupons->paginate($data['limit']);
        
        return $coupons;
    }
    
}


