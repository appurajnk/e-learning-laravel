<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Models\Course;
use App\Models\Payout;
use App\Models\Period;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utilities\Checker;
use Illuminate\Filesystem\Filesystem;

class AdminDashboardController extends Controller
{
    


    public function fetchAdminSalesChartData(Request $request)
    {
        $filter = $request->period;
        $periods = collect($this->generateDateRange(Carbon::now()->subDays($filter), Carbon::now()));
        $times = [];
        foreach($periods as $p){
            $times[$p] = 0;
        }
        $data = [];
        // Total Sales
        $sales = Payment::where('created_at', '>=', Carbon::now()->subDays($filter))
                        ->whereNull('refunded_at')
                        ->select(\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount) as total'))
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();
        $total_sales = [];
        foreach($sales as $val){
            $total_sales[$val->date] = (float)$val->total;
        }
        $grand_total = array_merge($times, $total_sales);
        array_push($data, [
            'name' => 'Total Sales',
            'data' => $grand_total
        ]);

        // get sales minus author commission
        $platform_earnings = Payment::where('created_at', '>=', Carbon::now()->subDays($filter))
                        ->whereNull('refunded_at')
                        ->select(\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount - author_earning - affiliate_earning) as total'))
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();
        
        $total_earnings = [];
        foreach($platform_earnings as $val){
            $total_earnings[$val->date] = (float)$val->total;
        }
        $grand_earnings = array_merge($times, $total_earnings);
        array_push($data, [
            'name' => 'Platform Earnings',
            'data' => $grand_earnings
        ]);

        // Total Refunds
        $refunds = Payment::where('created_at', '>=', Carbon::now()->subDays($filter))
                        ->whereNotNull('refunded_at')
                        ->select(\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount) as total'))
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();
        $total_refunds = [];
        foreach($refunds as $val){
            $total_refunds[$val->date] = (float)$val->total;
        }
        $grand_refunds = array_merge($times, $total_refunds);
        array_push($data, [
            'name' => 'Total Refunds',
            'data' => $grand_refunds
        ]);

        // total sales
        $lifetime_sales = Payment::whereNull('refunded_at')->sum('amount');
        $total_platform_earnings = Payment::whereNull('refunded_at')->select(\DB::raw('sum(amount - author_earning - affiliate_earning) as total'))->first();
        $lifetime_data = [
           'lifetime_sales' => $lifetime_sales ? (float)$lifetime_sales : 0,
           'lifetime_earnings' => $total_platform_earnings ? (float)$total_platform_earnings->total : 0
        ];

        // messages
        $messages = Checker::check();

        // periods requiring closure
        $periods_to_close = Period::where('status', 'open')
                            ->where('end_time', '<=', Carbon::now())
                            ->orderBy('end_time', 'desc')
                            ->get();

        $courses_to_approve = Course::where('published', true)
                                    ->where('approved', false)
                                    ->get();

        // $routes = app()->routes->getRoutes();
        // foreach($routes as $route){
        //     if($route->methods()[0] !== 'GET'){
        //         $san = "['method' => '" . $route->methods()[0] . "', 'uri' => '" . $route->uri . "'],";
        //         file_put_contents(base_path('ROUTELIST.txt'), $san.PHP_EOL, FILE_APPEND | LOCK_EX);
        //     }
        // }
    
        $res = [
            'chartData' => $data,
            'lifetimeData' => $lifetime_data,
            'messages' => $messages,
            'periods_to_close' => $periods_to_close,
            'courses_to_approve' => $courses_to_approve
        ];

        return response()->json($res, 200);

    }


    public function emptyDatabase()
    {
        try{
            \Eloquent::unguard();
            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            \App\Models\Transaction::truncate();
            \App\Models\Payout::truncate();
            \App\Models\Refund::truncate();
            \App\Models\Certificate::truncate();
            \App\Models\CartLine::truncate();
            \App\Models\Cart::truncate();
            \App\Models\Payment::truncate();
            \App\Models\Coupon::truncate();
            \App\Models\Comment::truncate();
            \App\Models\Video::truncate();
            \App\Models\Lesson::truncate();
            \App\Models\CourseTarget::truncate();
            \App\Models\Section::truncate();
            
            // delete demo users
            $users = User::whereBetween('id', [2, 5])->get();
            foreach($users as $user){
                $user->enrollments()->detach();
                $user->removeRole('user');
                $user->delete();
            }

            \App\Models\Course::truncate();

            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            \Eloquent::reguard();
            
            // clean files
            $file = new Filesystem;
            $file->cleanDirectory(public_path('uploads/images/course/thumbnails'));
            $file->cleanDirectory(public_path('uploads/videos'));
            \Artisan::call('cache:clear');
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessages()], 422);
        }
        

    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
    
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }
    
        return $dates;
    }


}

