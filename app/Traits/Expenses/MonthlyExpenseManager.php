<?php

namespace App\Traits\Expenses;

use App\Models\MonthlyExpense;

trait MonthlyExpenseManager
{
    public function modify(
        MonthlyExpense $monthlyExpense,
        int $amountInCents,
    ): MonthlyExpense {
        // TODO: Validation Rules
        // TODO: Policies

        $monthlyExpense->amount_in_cents = $amountInCents;
        $monthlyExpense->save();

        return $monthlyExpense;
    }

    public function reschedule(
        MonthlyExpense $monthlyExpense,
        string $dueDate
    ): MonthlyExpense {
        // TODO: Validation Rules
        // TODO: Policies

        $monthlyExpense->due_duate = $dueDate;
        $monthlyExpense->save();

        return $monthlyExpense;
    }

    public function unschedule(MonthlyExpense $monthlyExpense): void
    {
        // TODO: Validation Rules
        // TODO: Policies

        $monthlyExpense->delete();
    }
}
