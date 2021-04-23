<?php

namespace App\Repositories\Eloquent;

//use PayPalProvider;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Period;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\Transaction;
use App\Payment\PayPalProvider;
use App\Repositories\Contracts\IPayout;


class PayoutRepository extends RepositoryAbstract implements IPayout
{
    
    public function entity()
    {
        return Payout::class;
    }
    
    public function fetchAllPeriods(array $data)
    {
 
        $builder = (new Period)->newQuery();
        $now = Carbon::now('UTC');
        $builder->where('start_time', '<=', $now->startOfMonth());
        $builder->orderBy($data['sort'], $data['direction']);
        $periods = $builder->with(['payments', 'refunds'])->paginate($data['limit']);
        
        return $periods;
    }
    
    
    public function fetchPeriodByUuid($uuid)
    {
        return Period::where('uuid', $uuid)->first();
    }
    
    
    public function fetchStatementsByPeriod($uuid)
    {
        
        $purchases = Payment::whereNull('refunded_at')
                        ->whereHas('period', function($q) use ($uuid){
                            $q->where('uuid', $uuid);
                        })
                        ->with(['user', 'coupon', 'course.author'])
                        ->get();
        
        $data = [
            'purchases' => $purchases,
        ];
        
        return $data;
    }
    
  
    public function closePeriod($uuid)
    {
        $period = Period::where('uuid', $uuid)->first();
        $authors = User::has('authored_courses')->get();
            
        foreach($authors as $user){
            $payout_amount = $user->sales()->whereNull('refunded_at')->where('period_id', $period->id)->sum('author_earning');
            $period->payouts()->create([
               'user_id' => $user->id,
               'total_author_earnings' => $user->sales()->whereNull('refunded_at')->where('period_id', $period->id)->sum('author_earning'),
               'net_earnings' => $payout_amount,
               'total_refunds' => $user->sales()->whereNotNull('refunded_at')->where('period_id', $period->id)->sum('author_earning'),
               'is_processed' => $payout_amount == 0,
               'processed_at' => $payout_amount == 0 ? Carbon::now('UTC') : null
            ]);
        }
        
        $period->status = 'closed';
        $period->save();
        
        return $this->fetchPayoutsForPeriod($uuid);
        
    }

    public function closeAllOpenPeriods()
    {
        $authors = User::has('authored_courses')->get();
        $now = \Carbon\Carbon::now('UTC');
        $periods = Period::where('status', 'open')->where('end_time', '<=', $now)->get();
        foreach($periods as $period){
            foreach($authors as $user){
                $payout_amount = $user->sales()->whereNull('refunded_at')->where('period_id', $period->id)->sum('author_earning');
                if($existing = $user->payouts()->where('period_id', $period->id)->first())
                {
                    $existing->delete();
                }

                $period->payouts()->create([
                    'user_id' => $user->id,
                    'total_author_earnings' => $user->sales()->whereNull('refunded_at')->where('period_id', $period->id)->sum('author_earning'),
                    'net_earnings' => $payout_amount,
                    'total_refunds' => $user->sales()->whereNotNull('refunded_at')->where('period_id', $period->id)->sum('author_earning'),
                    'is_processed' => $payout_amount == 0,
                    'processed_at' => $payout_amount == 0 ? Carbon::now('UTC') : null
                ]);
            }
            $period->status = 'closed';
            $period->save();
        }
        
    }
    
    public function fetchPayoutsForPeriod($uuid)
    {
        $period = Period::where('uuid', $uuid)->first();
        $payouts = $period->payouts()->with('user')->get();
        return $payouts;
        
    }

    public function processPayout($uuid)
    {
        $payout = Payout::where('uuid', $uuid)->first();
        if(!$payout->user->paypal_email) return false;
        
        $provider = new PayPalProvider();
        $results = $provider->processPayout($payout);

        $payout->payout_batch_id = $results['batchId'];
        $payout->payout_batch_status = $results['batchStatus'];
        $payout->comment = 'Paid to PayPal via email address ' . $payout->user->paypal_email; // change to the user's payment gateway preference
        $payout->processed_at = Carbon::now('UTC');
        $payout->is_processed = true;
        $payout->gateway = 'PayPal';
        $payout->payment_address = $payout->user->paypal_email; // change this too
        $payout->save();
        return $payout;
    }

    public function fetchPayoutStatusUpdate($uuid)
    {
        $payout = Payout::where('uuid', $uuid)->first();
        $provider = new PayPalProvider();
        $status = $provider->getPayoutBatchStatus($payout); // PENDING, SUCCESS
        if($status){
            $payout->payout_batch_status = $status;
            $payout->save();
        }
        return $status;
    }
   
}