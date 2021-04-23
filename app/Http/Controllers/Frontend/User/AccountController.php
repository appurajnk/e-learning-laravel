<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.account.BasicInformation');
    }

    public function basicInformation()
    {
        $user = auth()->user();
        //return view('frontend.user.account.BasicInformation', compact('user'));
    }
    
    public function changePassword()
    {
        $user = auth()->user();
        return view('frontend.user.account.ChangePassword', compact('user'));
    }
    
    public function privacySettings()
    {
        $settings = auth()->user()->settings()->getMultiple(['payouts.email', 'payouts.method']);
        return view('frontend.user.account.PrivacySettings', compact('settings'));
    }
    
    public function payoutSettings()
    {
        $settings = auth()->user()->settings()->getMultiple(['paypal_email', 'payout_method']);
        return view('frontend.user.account.PayoutSettings', compact('settings'));
    }
}
