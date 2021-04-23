<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPayout;
use App\Http\Resources\PayoutResource;

class AdminPayoutController extends Controller
{
    
    protected $payouts;
    
    public function __construct(IPayout $payouts)
    {
        $this->payouts = $payouts;
    }
    
    
    public function index()
    {
        
        return view('backend.finances.Payouts');
    }
    
    
    public function payoutDetails($uuid)
    {
        
        $period = $this->payouts->fetchPeriodByUuid($uuid);
        return view('backend.finances.PayoutDetails', compact('period'));
    }
    
    
    
    
}
