<?php

namespace App\Jobs;

use App\Services\PayPeriods\PayPeriodBillService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAutoPaymentBillsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        resolve(PayPeriodBillService::class)->updateAutoPaymentBills();
    }
}
