<?php

namespace App\Listeners\Paystubs;

use App\Events\Paystubs\PaystubModified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModifyFuturePaystubs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(PaystubModified $event): void
    {
        $paystub = $event->paystub;

        $paystub->modifyFuturePaystubs($paystub);
    }
}
