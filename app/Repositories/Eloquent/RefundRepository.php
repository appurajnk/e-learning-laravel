<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\Period;
use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IRefund;
use Srmklive\PayPal\Services\ExpressCheckout;
use Razorpay\Api\Api;
use App\Payment\PayPalProvider;
use App\Events\UpdateCourseStats;


class RefundRepository  extends RepositoryAbstract implements IRefund
{
    
    public function entity()
    {
        return Refund::class;
    }
    
    public function createRefundRequest(array $data)
    {
        $payment = Payment::where('uuid', $data['course'])->first();
        $course = $payment->course;
        $refund =   auth()->user()->refunds()->create([
                       'payment_id' => $payment->id,
                       'transaction_id' => null,
                       'course_id' => $course->id,
                       'amount' => $payment->amount,
                       'comment' => $data['comment']
                    ]);
                    
        $transaction = $course->author->transactions()->create([
                'type' => 'debit',
                'description' => 'Refund',
                'long_description' => 'Refund of "'. $course->title . '" purchased by ' . $payment->user->full_name,
                'amount' => -$payment->author_earning
            ]);
             
        $refund->transaction_id = $transaction->id;
        $refund->save();
        
        return $refund;
    }
    
    public function fetchUserRefunds(array $data)
    {
        $refunds= auth()->user()->refunds()
                        ->with('course', 'payment')
                        ->orderBy($data['sort'], $data['direction'])
                        ->paginate($data['limit']);
            
        return $refunds;
    }
    
    public function fetchPaymentsThatCanBeRefunded()
    {
        $user_refund_courses = auth()->user()->refunds()->where('status', 'open')->pluck('course_id');
        $payments = auth()->user()->purchases()
                    ->whereNull('refunded_at')
                    ->where('refund_deadline', '>=', \Carbon\Carbon::now('UTC'))
                    ->whereHas('course', function($q) use ($user_refund_courses){
                        $q->whereNotIn('id', $user_refund_courses);
                    })
                    
                    ->with('course')
                    ->get();
                    
        return $payments;
    }
    
    
    public function getAdminRefunds(array $data)
    {
        $builder = (new Refund)->newQuery();
        
        if($data['status']){
            $builder->where('status', $data['status']);
        }
        
        if($data['query']){
            $builder->whereHas('requester', function($q) use ($data){
                $q->where('first_name', 'like', '%'.$data['query'].'%')
                    ->orWhere('last_name', 'like', '%'.$data['query'].'%')
                    ->orWhere('email', 'like', '%'.$data['query'].'%');
            });
        }
        
        if($data['sort'] == 'course.title'){
            $builder->orderByJoin('course.title', $data['direction']);
        } elseif($data['sort'] == 'requester.full_name') {
            $builder->orderByJoin('requester.first_name', $data['direction']);
        } elseif($data['sort'] == 'requester.email') {
            $builder->orderByJoin('requester.email', $data['direction']);
        } else {
            $builder->orderBy($data['sort'], $data['direction']);
        }
        
        $refunds = $builder->with(['course', 'payment', 'requester'])
                            ->paginate($data['limit']);
        
        return $refunds;
    }
    
    public function process(Request $request, $uuid)
    {
        $refund = Refund::where('uuid', $uuid)->first();
        $gateway = $refund->payment->payment_method;
        $charge_id = $refund->payment->gateway_payment_id;
        $status = '';
        $refunded_to = $gateway=='paypal' ? 'PayPal' : 'Credit Card';
        
        // process the refund on stripe
        if($gateway =='stripe'){
            try {
                if(setting('payments.stripe_mode') == 'live'){
                    \Stripe\Stripe::setApiKey(setting('payments.stripe_live_secret_key'));
                } else {
                    \Stripe\Stripe::setApiKey(setting('payments.stripe_sandbox_secret_key'));
                }
                $stripe_refund = \Stripe\Refund::create([
                    'charge' => $charge_id
                ]);
                $status = $stripe_refund->status == 'succeeded' ? 'success' : '';
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        if($gateway=='paypal'){
            try {
                $provider = new PayPalProvider;
                $result = $provider->processRefund($refund);
                if(strToUpper($result) == 'COMPLETED'){
                    $status = 'success';
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        if($gateway=='razorpay'){
            try {
                if(setting('payments.razorpay_mode') == 'live'){
                    $api = new Api(setting('payments.razorpay_live_public_key'), setting('payments.razorpay_live_secret_key'));
                } else {
                    $api = new Api(setting('payments.razorpay_sandbox_public_key'), setting('payments.razorpay_sandbox_secret_key'));
                }
                
                $response = $api->refund->create(array('payment_id' => $charge_id));
                $status = 'success';
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        // update the refund record
        if($status == 'success'){
            $refund->status = 'closed';
            $refund->processed_at = Carbon::now('UTC');
            $refund->refunded_to = $refunded_to;
            $refund->notes = "Payment refunded via Stripe";
            $refund->save();
            
            // unenroll the user
            $enrollment = $refund->requester->enrollments()->detach($refund->course->id);
            
            // mark payment as refunded
            $refund->payment->refunded_at = Carbon::now('UTC');
            $refund->payment->save();

            // delete any reviews this user has made to the course
            $reviews = $refund->course->reviews()->where('user_id', $refund->requester->id)->delete();

            // update course stats
            event(new UpdateCourseStats($refund->course, 'total_reviews'));
            event(new UpdateCourseStats($refund->course, 'total_students'));
        }
            
        return $refund;
    }
    
    
    
}


