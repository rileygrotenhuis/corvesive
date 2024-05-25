<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyPaystub;

trait MonthlyPaystubManager
{
    /**
     * Modifies the amount value for a Monthly Paystub.
     */
    public function modify(
        MonthlyPaystub $monthlyPaystub,
        int $amountInCents
    ): MonthlyPaystub {
        $monthlyPaystub->amount_in_cents = $amountInCents;
        $monthlyPaystub->save();

        return $monthlyPaystub;
    }

    /**
     * Reschedules a Monthly Paystub for a specific date.
     */
    public function reschedule(
        MonthlyPaystub $monthlyPaystub,
        string $payDay
    ): MonthlyPaystub {
        $monthlyPaystub->pay_day = $payDay;
        $monthlyPaystub->save();

        return $monthlyPaystub;
    }

    /**
     * Un-schedules a Monthly Paystub.
     */
    public function unschedule(MonthlyPaystub $monthlyPaystub): void
    {
        $monthlyPaystub->delete();
    }
}
