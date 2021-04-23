<?php
namespace App\Repositories\Contracts;

interface IPayment extends IRepository
{
    public function process(array $data, $gateway, $gateway_payment_id);
    public function getReceiptData($payment_id);
    
}