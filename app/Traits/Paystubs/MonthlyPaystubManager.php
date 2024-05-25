<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyPaystub;

trait MonthlyPaystubManager
{
    public function modify(
        MonthlyPaystub $monthlyPaystub,
        int $amountInCents
    ): MonthlyPaystub {
        // TODO: Validation Rules
        // TODO: Policies

        $monthlyPaystub->amount_in_cents = $amountInCents;
        $monthlyPaystub->save();

        return $monthlyPaystub;
    }

    public function reschedule(
        MonthlyPaystub $monthlyPaystub,
        string $payDay
    ): MonthlyPaystub {
        // TODO: Validation Rules
        // TODO: Policies

        $monthlyPaystub->pay_day = $payDay;
        $monthlyPaystub->save();

        return $monthlyPaystub;
    }

    public function unschedule(MonthlyPaystub $monthlyPaystub): void
    {
        // TODO: Validation Rules
        // TODO: Policies

        $monthlyPaystub->delete();
    }
}
