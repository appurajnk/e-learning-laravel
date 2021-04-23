<?php

namespace App\Http\Controllers\Api\v1\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IRefund;
use App\Http\Resources\RefundResource;
use App\Notifications\Frontend\RefundRequestProcessed;

class AdminRefundController extends Controller
{
    protected $refunds;
    
    public function __construct(IRefund $refunds)
    {
        $this->refunds = $refunds;
    }
    
    public function index(Request $request)
    {
        $refunds = $this->refunds->getAdminRefunds($request->all());
        return RefundResource::collection($refunds);
    }
    
    public function process(Request $request, $uuid)
    {
        $refund = $this->refunds->process($request, $uuid);
        try{
            $refund->requester->notify(new RefundRequestProcessed($refund));        
        } catch(\Exception $e){
            report($e);
            return response()->json($refund, 200);
        }
        
        return response()->json($refund, 200);
    }
    
}
