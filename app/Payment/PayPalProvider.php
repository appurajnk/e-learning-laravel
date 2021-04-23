<?php

namespace App\Payment;

use PayPal\Api\Sale;
use App\Models\Refund;
use App\Models\Payout;
use PayPal\Api\Amount;
use PayPal\Rest\ApiContext;
use PayPal\Api\RefundRequest;
use PayPal\Api\Payment as PayPalPayment;
use PayPal\Api\Refund as PayPalRefund;
use PayPal\Api\Payout as PayPalPayout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;

use PayPal\Auth\OAuthTokenCredential;

class PayPalProvider
{

    private $_api_context;

    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');

        $client_id = setting('payments.paypal_mode') == 'live' ? setting('payments.paypal_live_client_id') : setting('payments.paypal_sandbox_client_id');
        $secret = setting('payments.paypal_mode') == 'live' ? setting('payments.paypal_live_secret') : setting('payments.paypal_sandbox_secret');

        $this->_api_context = new ApiContext(new OAuthTokenCredential($client_id, $secret));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function processRefund(Refund $refund)
    {
        
        $amt = new Amount();
        $amt->setCurrency(setting('site.site_currency') ?? 'USD')
            ->setTotal($refund->payment->amount);
        
        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amt);

        $payment = PayPalPayment::get($refund->payment->gateway_payment_id, $this->_api_context);
        $sale_id = $payment->getTransactions()[0]->getRelatedResources()[0]->sale->id;
        $sale = new Sale();
        $sale->setId($sale_id);
        $refundedSale = $sale->refundSale($refundRequest, $this->_api_context);

        return $refundedSale->getState();
    }

    
    public function processPayout(Payout $payout)
    {
        $payouts = new PayPalPayout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");

        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver($payout->user->paypal_email) 
            ->setSenderItemId($payout->uuid)
            ->setAmount(new Currency('{ "value": "'. $payout->net_earnings . '", "currency": "'. setting('site.site_currency') .'"  }'  ));
        
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem); 
        
        // ### Create Payout
        try {
            $payoutBatch = $payouts->create(null, $this->_api_context);
            return [
                "batchId" => $payoutBatch->getBatchHeader()->payout_batch_id,
                "batchStatus" => $payoutBatch->getBatchHeader()->batch_status
            ];
        } catch (Exception $ex) {
            exit(1);
        }
        
    }


    public function getPayoutBatchStatus(Payout $payout)
    {
        $batchId = $payout->payout_batch_id;
        try {
            $output = PayPalPayout::get($batchId, $this->_api_context);
            return $output->getBatchHeader()->batch_status;
        } catch (Exception $ex) {
            exit(1);
        }
    }



}