<?php

namespace App\Http\Controllers\Frontend\Payment;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPayment;
use App\Repositories\Contracts\ICart;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    
    protected $payments;
    protected $provider;
    protected $carts;

    public function __construct(IPayment $payments, ICart $carts)
    {
        $this->payments = $payments;
        $this->carts = $carts;
        $this->provider = new ExpressCheckout();
    }
    
    public function getExpressCheckout(Request $request)
    {
        $data = $this->carts->fetchItems();
        $courses = $data['items']->pluck('product_id')->toArray();
        $mycart = $data['cart']->id;

        $cart = $this->getCheckoutData($data);
        session()->put('cart_data', $cart);
        session()->put('courses', $courses);
        session()->put('cart', $mycart);
        
        try {
            /* Use this to get credentials from settings database instead of environment file */
            // $config=[];
            // $config['mode'] = setting('payments.paypal_mode');
            // $config['username'] = setting('payments.paypal_mode')=='sandbox' ? setting('payments.paypal_sandbox_api_username') : setting('payments.paypal_live_api_username');
            // $config['password'] = setting('payments.paypal_mode')=='sandbox' ? setting('payments.paypal_sandbox_api_password') : setting('payments.paypal_live_api_password');
            // $config['secret'] = setting('payments.paypal_mode')=='sandbox' ? setting('payments.paypal_sandbox_api_secret') : setting('payments.paypal_live_api_secret');
            // $config['currency'] = settings('site.default_currency');
            // $this->provider->setApiCredentials($config);

            $response = $this->provider->setCurrency( setting('site.site_currency') ?? 'USD')->setExpressCheckout($cart);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment"]);
        }
    }
    
    public function getExpressCheckoutSuccess(Request $request)
    {
        
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $cart = session()->get('cart_data');
        
        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);
        
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // Perform transaction on PayPal
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            
            if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
                $transaction_id = $payment_status['PAYMENTINFO_0_TRANSACTIONID'];
                // save to database
                session()->put(['code' => 'success', 'message' => "Payment successful!"]);
                
                $payload = [
                    'cart' => session()->get('cart'),
                    'courses' => session()->get('courses')
                ];
                $this->payments->process($payload, 'paypal', $transaction_id);
                session()->forget(['cart', 'cart_data', 'courses']);
                
                return redirect()->route('frontend.index');
            } else {
                session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment"]);
                return redirect()->route('frontend.cart.checkout');
            }
        }
    }
    
    protected function getCheckoutData($checkoutData)
    {
        
        $items = [];
        foreach($checkoutData['items'] as $item){
            $course = $item->product;
            $d = [
                'name' => $course->title,
                'qty' => 1,
                'price' => (float)$item->purchase_price
            ];
            array_push($items, $d);
        }
        
        $data = [];
        $data['items'] = $items;
        $data['return_url'] = url('/payment/paypal/ec-success');
        $data['invoice_id'] = Str::uuid();
        $data['invoice_description'] = "Course purchase";
        $data['cancel_url'] = url('/cart/checkout');
        $data['total'] = (float)$checkoutData['cart']->total_purchase_price;
        
        return $data;
    }

    
    
}
