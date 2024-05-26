<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyExpense;
use App\Models\MonthlyPaystub;
use App\Models\PaydayTask;

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

    /**
     * Schedules a Payday Task for the Monthly Paystub.
     */
    public function newTask(
        MonthlyExpense $monthlyExpense,
        int $amountInCents,
    ): PaydayTask {
        return PaydayTask::query()->create([
            'user_id' => $this->user_id,
            'monthly_paystub_id' => $this->id,
            'monthly_expense_id' => $monthlyExpense->id,
            'amount_in_cents' => $amountInCents,
        ]);
    }
}
