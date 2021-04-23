<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IRevenue extends IRepository
{
    
    public function getUserRevenueByPeriod(Request $request);
    public function fetchStatementDetails($uuid);
    

}