<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPayment;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{

    private $payments;

    public function __construct(IPayment $payments)
    {
        $this->payments = $payments;
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return redirect(route('frontend.user.account'));
    }

    public function courses()
    {
        return view('frontend.user.dashboard.Courses');
    }
    
    public function wishlist()
    {
        return view('frontend.user.dashboard.Wishlist');
    }
    
    public function purchases()
    {
        return view('frontend.user.dashboard.PurchaseHistory')->with(['user' => auth()->user()]);
    }

    public function receipt($payment_id)
    {
        // fetch user purchase data
        $payment = $this->payments->getReceiptData($payment_id);
        //dd($payment);
        return view('frontend.user.dashboard.Receipt', compact('payment'));
    }
}
