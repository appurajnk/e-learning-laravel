<?php

namespace App\Http\Controllers\Api\v1\General\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IUserDashboard;
use App\Repositories\Contracts\IRefund;
use App\Notifications\Frontend\RefundRequestReceived;
use App\Http\Resources\CourseResource;

class DashboardController extends Controller
{
    protected $dashboard;
    protected $refunds;
    
    public function __construct(IUserDashboard $dashboard, IRefund $refunds)
    {
        $this->dashboard = $dashboard;
        $this->refunds = $refunds;
    }
    
    public function fetchCourses(Request $request)
    {
        $courses = CourseResource::collection( $this->dashboard->findUserCourses($request->all()));
        return $courses;
    }
    
    public function fetchUserCourseCategories()
    {
        $categories = $this->dashboard->findUserCourseCategories();
        return response()->json($categories, 200);
    }
    
    public function fetchPurchaseHistory(Request $request)
    {
        $purchases = $this->dashboard->fetchPurchaseHistory($request->all());
        return response()->json($purchases, 200);
    }
    
    public function createRefundRequest(Request $request)
    {
        
        $this->validate($request, [
            'comment' => 'required',
            'course' => 'required|payment_can_be_refunded|refund_request_does_not_yet_exist'
        ]);
        $refund = $this->refunds->createRefundRequest($request->all());

        try{
            //$when = now()->addMinutes(10);
            //auth()->user()->notify((new RefundRequestReceived($refund))->delay($when));
            auth()->user()->notify(new RefundRequestReceived($refund));
        } catch(\Exception $e){
            // Report the exception but continue with the request without rendering an error page
            report($e);
            return response()->json(null, 200);
        }
        

    }
    
    public function fetchUserRefunds(Request $request)
    {
        $refunds = $this->refunds->fetchUserRefunds($request->all());
        return response()->json($refunds, 200);
    }
    
    public function fetchPaymentsThatCanBeRefunded()
    {
        $payments = $this->refunds->fetchPaymentsThatCanBeRefunded();
        return response()->json($payments, 200);
    }
}
