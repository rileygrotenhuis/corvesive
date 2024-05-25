<?php

namespace App\Listeners;

use App\Events\PaystubModified;
use App\Models\MonthlyPaystub;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModifyFuturePaystubs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(PaystubModified $event): void
    {
        $paystub = $event->paystub;

        $today = now()->format('Y-m-d');

        MonthlyPaystub::query()
            ->where('paystub_id', $paystub->id)
            ->where('pay_date', '>=', $today)
            ->update([
                'amount_in_cents' => $paystub->amount_in_cents,
            ]);
    }
}
