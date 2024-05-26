<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyExpense;
use App\Models\MonthlyPaystub;
use App\Models\PaydayTask;
use App\Models\Payment;

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
    public function modifyTask(int $amountInCents): PaydayTask
    {
        $this->amount_in_cents = $amountInCents;
        $this->save();

        return $this;
    }

    /**
     * Removes a Payday Task entirely.
     */
    public function removeTask(): void
    {
        $this->delete();
    }

    /**
     * Completes a Payday Task and pays the expense.
     */
    public function completeTask(): Payment
    {
        $payment = $this->monthlyExpense->payment(
            now()->format('Y-m-d'),
            $this->amount_in_cents
        );

        $this->is_completed = true;
        $this->save();

        return $payment;
    }
}
