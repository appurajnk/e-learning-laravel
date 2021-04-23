<?php

namespace App\Http\Controllers\Api\v1\Author;

use Carbon\Carbon;
use App\Models\Period;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IRevenue;

class AuthorRevenueController extends Controller
{
    
    public $revenue;
    
    public function __construct(IRevenue $revenue)
    {
        $this->revenue = $revenue;   
    }
    
    public function getAuthorRevenue(Request $request)
    {
        $earnings = $this->revenue->getUserRevenueByPeriod($request);
        return response()->json($earnings, 200);
    }
    
    public function getSalesChartData(Request $request)
    {
        $earnings = $this->revenue->getSalesChartData($request);
        return response()->json($earnings, 200);
    }
    
    public function fetchStatementDetails(Request $request)
    {
        $sales = $this->revenue->fetchStatementDetails($request->statement);
        return response()->json($sales, 200);
    }
    
    
    
}
