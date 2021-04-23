<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICoupon;
use App\Http\Resources\CouponResource;

class AuthorCouponController extends Controller
{
    
    protected $coupons;

    public function __construct(ICoupon $coupons)
    {
        $this->coupons = $coupons;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    
    public function findByCourse(Request $request, $id)
    {
        $coupons = $this->coupons->findByCourse($request->all(), $id);
        
        return CouponResource::collection($coupons);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
