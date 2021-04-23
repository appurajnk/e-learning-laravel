<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPayout;
use App\Http\Resources\PeriodResource;
use App\Http\Resources\PayoutResource;
use App\Notifications\Backend\PayoutProcessed;
use App\Notifications\Backend\UserPayPalEmailReminder;


class AdminPayoutController extends Controller
{
    
    
    protected $payouts;
    
    public function __construct(IPayout $payouts)
    {
        $this->payouts = $payouts;
    }
    
    public function fetchPeriods(Request $request)
    {
        $periods = $this->payouts->fetchAllPeriods($request->all());
        return PeriodResource::collection($periods);
    }

    public function fetchPeriod($uuid)
    {
        $payouts = PayoutResource::collection($this->payouts->fetchPayoutsForPeriod($uuid));
        $period = $this->payouts->fetchPeriodByUuid($uuid);
        $statements = $this->payouts->fetchStatementsByPeriod($uuid);

        
        return response()->json([
            'period' => $period,
            'data' => $statements,
            'payouts' => $payouts
        ]);
    }
    
    public function closePeriod($uuid)
    {
        $payouts = $this->payouts->closePeriod($uuid);
        return PayoutResource::collection($payouts);
    }
    
    public function fetchPayoutsForPeriod($uuid)
    {
        $payouts = $this->payouts->fetchPayoutsForPeriod($uuid);
        return PayoutResource::collection($payouts);
    }

    public function processPayout($uuid)
    {
        $payout = $this->payouts->processPayout($uuid);

        if(!$payout)return response()->json(['message' => 'PayPal Email Missing'], 422);
        
        try{
            $payout->user->notify(new PayoutProcessed($payout));        
        } catch(\Exception $e){
            report($e);
            return response()->json($refund, 200);
        }
        return $payout;
    }

    public function fetchPayoutStatusUpdate($uuid)
    {
        return $this->payouts->fetchPayoutStatusUpdate($uuid);
    }

    public function sendEmailReminder(Request $request)
    {
        $payout = $this->payouts->find($request->payout);
        try{
            $payout->user->notify(new UserPayPalEmailReminder($payout));
        } catch(\Exception $e){
            report($e);
            return response()->json(null, 422);
        }
    }
    
    
    
}
