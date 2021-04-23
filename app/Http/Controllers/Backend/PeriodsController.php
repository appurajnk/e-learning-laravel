<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Period;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeriodsController extends Controller
{
    
    
    
    public function generatePaymentPeriods(Request $request)
    {
       
        /*$start_year = $request->start_year;
        $end_year = $request->end_year;
        $interval = $request->interval;
        $periods = \Carbon\CarbonPeriod::create($start_year, $interval, $end_year);
        $delete_all = $request->delete_all;*/
        
        
        dd("No go");
         
        $start_year = Carbon::parse('2019-01-01');
        $end_year = Carbon::parse('2040-12-31');
        $interval = '1 month';
        $delete_all = true;
        $periods = \Carbon\CarbonPeriod::create($start_year, $interval, $end_year);
        
        // first truncate the periods table
        if($delete_all==true){
            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Period::truncate();
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        
        // insert new periods
        foreach ($periods as $date) {
            $start = $date->copy();
            $end = $date->copy()->add('2 months');
            $now = Carbon::now('UTC');
            $payout_date = $end->copy()->add('1 week');
            $status = $payout_date < $now->startOfMonth() ? 'closed' : 'open';

            Period::create([
               'start_time' => $start,
               'end_time' => $end,
               'payout_date' => $payout_date,
               'status' => $status
            ]);
        }
        
        
        
        
    }
    
    
}
