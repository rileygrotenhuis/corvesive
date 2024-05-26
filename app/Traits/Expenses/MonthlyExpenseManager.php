<?php

namespace App\Traits\Expenses;

use App\Models\MonthlyExpense;

trait MonthlyExpenseManager
{
    /**
     * Modifies the amount value for a Monthly Expense.
     */
    public function modify(int $amountInCents): MonthlyExpense
    {
        $this->amount_in_cents = $amountInCents;
        $this->save();

        return $this;
    }

    /**
     * Reschedules a Monthly Expense for a specific date.
     */
    public function reschedule(string $dueDate): MonthlyExpense
    {
        $this->due_duate = $dueDate;
        $this->save();

        return $this;
    }

    /**
     * Un-schedules a Monthly Expense.
     */
    public function unschedule(): void
    {
        $this->delete();
    }
}
