<?php

namespace App\Http\Controllers\Frontend\Payment;

use URL;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Sale;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\IPayment;
use App\Repositories\Contracts\ICart;

class PayPalCheckoutController extends Controller
{
    private $_api_context;
    protected $payments;
    protected $carts;
    
    public function __construct(IPayment $payments, ICart $carts)
    {
        $this->payments = $payments;
        $this->carts = $carts;

        $paypal_conf = \Config::get('paypal');

        $client_id = setting('payments.paypal_mode') == 'live' ? setting('payments.paypal_live_client_id') : setting('payments.paypal_sandbox_client_id');
        $secret = setting('payments.paypal_mode') == 'live' ? setting('payments.paypal_live_secret') : setting('payments.paypal_sandbox_secret');

        $this->_api_context = new ApiContext(new OAuthTokenCredential($client_id, $secret));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function charge(Request $request)
    {
        
        $data = $this->carts->fetchItems();
        $total = (float)$data['cart']->total_purchase_price;
        $courses = $data['items']->pluck('product_id')->toArray();
        $mycart = $data['cart']->id;
        $cur = setting('site.site_currency') ?? 'USD';
        
        $items = [];
        foreach($data['items'] as $item){
            $course = $item->product;
            $line = new Item();
            $line->setName($course->title)
                ->setCurrency($cur)
                ->setQuantity(1)
                ->setPrice((float)$item->purchase_price);
            array_push($items, $line);
        }
        $item_list = new ItemList();
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency($cur)
            ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Course purchase');
        
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('frontend.paypal.success'))
            ->setCancelUrl(URL::route('frontend.paypal.success'));

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                session()->put('error', 'Connection Timeout');
                return redirect()->route('frontend.cart.checkout'); 
            } else {
                session()->put('error', 'An error was encountered while processing your payment. Please try again');
                return redirect()->route('frontend.cart.checkout');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        //dd($payment);
        
        session()->put([
                        'paypal_payment_id' => $payment->getId(), 
                        'cart' => $mycart,
                        'course_ids' => $courses,
                        'amount' => $total
                    ]);
        
        if(isset($redirect_url)) {
            return redirect()->away($redirect_url);
        }
        
        session()->put('error', 'An error was encountered while processing your payment. Please try again');
        return redirect()->route('frontend.cart.checkout'); 
    }
    
    
    
    public function paymentStatus(Request $request)
    {
        $amount = session()->get('amount');
        $payment_id = session()->get('paypal_payment_id');
        session()->put(['paypal_payment_id', 'cart_data', 'course_ids', 'amount']);
        
        if (empty($request->PayerID) || empty($request->token)) {
            \session()->put('error', 'Payment failed. Please try again.');
            return redirect()->route('frontend.cart.checkout'); // check url
        }
        
        $payment = Payment::get($payment_id, $this->_api_context);
        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') { 
            $payload = [
                'cart' => session()->get('cart'),
                'courses' => session()->get('course_ids')
            ];
            $this->payments->process($payload, 'paypal', $payment_id);
            return redirect('/home/my-courses/learning');
        } else {
            return redirect(route('frontend.cart.checkout'))->withFlashDanger('Error processing payment. Please try again.');
        }
        
    }

}
