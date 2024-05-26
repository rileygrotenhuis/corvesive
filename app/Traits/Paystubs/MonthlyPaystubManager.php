<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyPaystub;

trait MonthlyPaystubManager
{
    /**
     * Modifies the amount value for a Monthly Paystub.
     */
    public function modify(int $amountInCents): MonthlyPaystub
    {
        $this->amount_in_cents = $amountInCents;
        $this->save();

        return $this;
    }

    /**
     * Reschedules a Monthly Paystub for a specific date.
     */
    public function reschedule(string $payDay): MonthlyPaystub
    {
        $this->pay_day = $payDay;
        $this->save();

        return $this;
    }

    /**
     * Un-schedules a Monthly Paystub.
     */
    public function unschedule(): void
    {
        $this->delete();
    }
}
