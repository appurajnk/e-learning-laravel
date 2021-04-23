<?php

namespace App\Http\Controllers\Api\v1\Payment;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPayment;

class RazorPayController extends Controller
{
    
    protected $payments;

    public function __construct(IPayment $payments)
    {
        $this->payments = $payments;
    }
    
    
    public function process(Request $request)
    {
        if(setting('payments.razorpay_mode') == 'live'){
            $api = new Api(setting('payments.razorpay_live_public_key'), setting('payments.razorpay_live_secret_key'));
        } else {
            $api = new Api(setting('payments.razorpay_sandbox_public_key'), setting('payments.razorpay_sandbox_secret_key'));
        }

        //$api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $payment = $api->payment->fetch($request->razorpay_payment_id);
        
        if(!empty($request->razorpay_payment_id)){
            try {
                $response = $api->payment->fetch($request->razorpay_payment_id)
                                ->capture(array('amount' => $payment['amount'])); 
                return $this->payments->process($request->all(), 'razorpay', $response->id);
            } catch (\Exception $e) {
                return  $e->getMessage();
            }
        } else {
            //
        }
        
    }
    
    
}
