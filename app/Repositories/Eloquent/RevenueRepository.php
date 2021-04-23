<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\Period;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IRevenue;

class RevenueRepository  extends RepositoryAbstract implements IRevenue
{
    public function entity()
    {
        return Payment::class;
    }
    
    public function getUserRevenueByPeriod(Request $request)
    {
  
        $now = Carbon::now('UTC');
        $periods = Period::where('start_time', '<=', $now->startOfMonth())
                            ->orderBy($request->sortBy, $request->direction)
                            ->paginate($request->limit);
                            
        foreach($periods as $period):
            $earnings = $this->get_author_earnings_for_period($period, auth()->user()); 
            $period->total_revenue =  $earnings->sum('author_earning');
            $period->total_revenue_money =  '$'.$earnings->sum('author_earning');
            $period->report_url = "/home/instructor/statements/{$period->uuid}";
            $period->expected_payment_date = $period->payout_date->format('M d, Y');
        endforeach;
        
        return $periods;
    }
    
    
    public function getSalesChartData(Request $request)
    {
        if($request->period == 'all'){
            $start_year = \Carbon\Carbon::parse('2019-01-01');
        } else {
            $start_year = \Carbon\Carbon::now('UTC')->subDays($request->period);
        }
        
        $end_year = \Carbon\Carbon::now('UTC')->endOfMonth();
        $interval = '1 day';
        $periods = \Carbon\CarbonPeriod::create($start_year, $interval, $end_year);
        
        $total_sales = [];
        foreach($periods as $period){
            $dt = $period->format('M y');
            $total_sales[$dt] = (float)$this->get_user_total_sales($period, 'total');
        }
        
        $promo_sales = [];
        foreach($periods as $period){
            $dt = $period->format('M y');
            $promo_sales[$dt] = (float)$this->get_user_total_sales($period, 'user_promo');
        }
        
        $organic_sales = [];
        foreach($periods as $period){
            $dt = $period->format('M y');
            $organic_sales[$dt] = (float)$this->get_user_total_sales($period, 'organic');
        }
        
        $refund = [];
        foreach($periods as $period){
            $dt = $period->format('M y');
            $refund[$dt] = (float)$this->get_user_total_sales($period, 'refund');
        }
        
        $res = array(
            ['name' => trans('strings.your_promotion'), 'data' => $promo_sales ],
            ['name' => trans('strings.organic_sales'), 'data' => $organic_sales ],
            ['name' => trans('strings.refunds'), 'data' => $refund ]
        );
        
        return $res;
    }
    
    
    public function fetchStatementDetails($uuid)
    {
        $period = $uuid;
        $purchases = auth()->user()->sales()
                        ->whereNull('refunded_at')
                        ->whereHas('period', function($q) use ($period){
                            $q->where('uuid', $period);
                        })
                        ->with(['user', 'coupon', 'course'])
                        ->get();
                        
        $refunds = auth()->user()->sales()
                        ->whereNotNull('refunded_at')
                        ->whereHas('period', function($q) use ($period){
                            $q->where('uuid', $period);
                        })
                        ->with(['user', 'coupon', 'course'])
                        ->get();
                        
        $data = [
            'purchases' => $purchases,
            'refunds' => $refunds
        ];
        
        return $data;
    }
    
    
    protected function get_author_earnings_for_period($period, $user)
    {
        $user_courses = $user->authored_courses->pluck('id');
        $earnings = $period->payments()
                    ->whereNull('refunded_at')
                    ->whereIn('course_id', $user_courses)
                    ->get();
        return $earnings;
    }
    
    protected function get_user_total_sales($period, $metric)
    {
        $p = Period::where('start_time', $period->startOfMonth())->first();
        
        $sales = $p->payments()
                    ->whereHas('course', function($c){
                        $c->where('user_id', auth()->id());
                    });
                    
        if($metric == 'total'){
            $sales = $sales->whereNull('refunded_at');
        }
        
        if($metric == 'user_promo'){
            $sales = $sales->whereNull('refunded_at')
                            ->whereHas('coupon', function($q){
                                $q->where('sitewide', false);
                            });
        }
        
        if($metric == 'organic'){
            $sales = $sales->whereNull('refunded_at')
                            ->where(function($q){
                                $q->whereHas('coupon', function($c){
                                        $c->where('sitewide', true);
                                    })
                                    ->orWhereNull('coupon_id');
                            });
                            
        }
        
        if($metric == 'refund'){
            $sales = $sales->whereNotNull('refunded_at');
        }
                    
        return $sales->sum('author_earning');
    }

}


