<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Contracts\IPayout;

class ClosePeriods extends Command
{

    protected $signature = 'arcinspire:closeperiods';
    protected $description = 'Close any payout periods that require closing.';
    protected $payouts;

    public function __construct(IPayout $payouts)
    {
        parent::__construct();
        $this->payouts = $payouts;
    }

   
    public function handle()
    {
        $this->payouts->closeAllOpenPeriods();
    }
}
