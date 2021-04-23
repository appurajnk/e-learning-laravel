<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;
interface IRefund extends IRepository
{
    
    public function createRefundRequest(array $data);
    public function fetchUserRefunds(array $data);
    public function fetchPaymentsThatCanBeRefunded();
    public function process(Request $request, $uuid);
    public function getAdminRefunds(array $data);
}