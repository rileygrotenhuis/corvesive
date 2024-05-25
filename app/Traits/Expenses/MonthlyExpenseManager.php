<?php

namespace App\Traits\Expenses;

use App\Models\MonthlyExpense;

trait MonthlyExpenseManager
{
    /**
     * Modifies the amount value for a Monthly Expense.
     */
    public function modify(
        MonthlyExpense $monthlyExpense,
        int $amountInCents,
    ): MonthlyExpense {
        $monthlyExpense->amount_in_cents = $amountInCents;
        $monthlyExpense->save();

        return $monthlyExpense;
    }

    /**
     * Reschedules a Monthly Expense for a specific date.
     */
    public function reschedule(
        MonthlyExpense $monthlyExpense,
        string $dueDate
    ): MonthlyExpense {
        $monthlyExpense->due_duate = $dueDate;
        $monthlyExpense->save();

        return $monthlyExpense;
    }

    /**
     * Un-schedules a Monthly Expense.
     */
    public function unschedule(MonthlyExpense $monthlyExpense): void
    {
        $monthlyExpense->delete();
    }
}
