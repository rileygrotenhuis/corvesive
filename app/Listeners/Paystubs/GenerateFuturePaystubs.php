<?php

namespace App\Listeners\Paystubs;

use App\Events\Paystubs\PaystubCreated;

class GenerateFuturePaystubs
{
    public function handle(PaystubCreated $event): void
    {
        $paystub = $event->paystub;

        $paystub->generateFutureExpenses($paystub);
    }
}
