<?php

namespace App\Listeners\Paystubs;

use App\Events\Paystubs\PaystubRescheduled;

class RescheduleFuturePaystubs
{
    public function handle(PaystubRescheduled $event): void
    {
        $paystub = $event->paystub;

        $paystub->unscheduleFuturePaystubs();
        $paystub->generateFutureExpenses();
    }
}
