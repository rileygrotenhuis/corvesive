<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyPaystub;
use App\Models\Paystub;

trait PaystubScheduler
{
    public function schedule(
        Paystub $paystub,
        int $year,
        int $month,
        string $payDay,
        int $amountInCents
    ): MonthlyPaystub {
        // TODO: Validation Rules
        // TODO: Policies

        return MonthlyPaystub::query()->create([
            'user_id' => $paystub->user_id,
            'paystub_id' => $paystub->id,
            'year' => $year,
            'month' => $month,
            'pay_day' => $payDay,
            'amount_in_cents' => $amountInCents,
        ]);
    }

    public function generateFutureExpenses(Paystub $paystub): void
    {
        // TODO: Logic
    }

    public function modifyFuturePaystubs(Paystub $paystub): void
    {
        $today = now()->format('Y-m-d');

        MonthlyPaystub::query()
            ->where('paystub_id', $paystub->id)
            ->where('pay_date', '>=', $today)
            ->update([
                'amount_in_cents' => $paystub->amount_in_cents,
            ]);
    }
}
