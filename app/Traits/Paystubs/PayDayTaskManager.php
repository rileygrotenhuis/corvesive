<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyExpense;
use App\Models\MonthlyPaystub;
use App\Models\PaydayTask;

trait PayDayTaskManager
{
    /**
     * Creates a new Payday Task.
     */
    public static function newTask(
        MonthlyPaystub $monthlyPaystub,
        MonthlyExpense $monthlyExpense,
        int $amountInCents,
    ): PaydayTask {
        return PaydayTask::query()->create([
            'user_id' => $monthlyPaystub->user_id,
            'monthly_paystub_id' => $monthlyPaystub->id,
            'monthly_expense_id' => $monthlyExpense->id,
            'amount_in_cents' => $amountInCents,
        ]);
    }

    /**
     * Changes the amount value for the Payday Task
     */
    public function modifyTask(
        PaydayTask $paydayTask,
        int $amountInCents
    ): PaydayTask {
        $paydayTask->amount_in_cents = $amountInCents;
        $paydayTask->save();

        return $paydayTask;
    }

    /**
     * Removes a Payday Task entirely.
     */
    public function removeTask(PaydayTask $paydayTask): void
    {
        $paydayTask->delete();
    }
}
