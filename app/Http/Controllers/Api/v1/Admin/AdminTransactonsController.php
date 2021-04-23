<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ITransaction;
use App\Http\Resources\TransactionResource;

class AdminTransactonsController extends Controller
{
    
    protected $transactions;
    
    public function __construct(ITransaction $transactions)
    {
        $this->transactions = $transactions;
    }
    
    
    public function index(Request $request)
    {
        $transactions = $this->transactions->fetchAll($request->all());
        return TransactionResource::collection($transactions);
    }
}
