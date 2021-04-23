<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ICoupon;
use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;

class AdminCouponController extends Controller
{
    
    protected $coupons;
    
    public function __construct(ICoupon $coupons)
    {
        $this->coupons = $coupons;
    }
    
    public function index(Request $request)
    {
        $coupons = $this->coupons->getAdminCoupons($request->all());
        return CouponResource::collection($coupons);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|alpha_dash|unique:coupons,code,NULL,id,course_id,' . $request->course,
            'percent' => 'required|numeric|max:100|min:5',
            'quantity' => 'required|numeric|min:1'
        ]);
        
        return $this->coupons->create($request->all());
    }
    
    public function activate($id)
    {
        return $this->coupons->activate($id);
    }
}
