<?php

namespace App\Http\Controllers\Api\v1\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPayment;

class StripePaymentController extends Controller
{
    
    protected $payments;

    public function __construct(IPayment $payments)
    {
        $this->payments = $payments;
    }
    
    
    public function process(Request $request)
    {
        $token = $request->token;
        
        if(setting('payments.stripe_mode') == 'live'){
            \Stripe\Stripe::setApiKey(setting('payments.stripe_live_secret_key'));
        } else {
            \Stripe\Stripe::setApiKey(setting('payments.stripe_sandbox_secret_key'));
        }
                
        $charge = \Stripe\Charge::create(array(
            "amount" => $request->purchase_price * 100,
            "currency" => setting('site.site_currency') ?? 'USD',
            "description" => "Course purchase on " . setting('site.site_name'),
            "source" => $token
        ));

        if($charge){
            return $this->payments->process($request->all(), 'stripe', $charge->id);
        } else {
            
        }
        
    }
    
    
}
