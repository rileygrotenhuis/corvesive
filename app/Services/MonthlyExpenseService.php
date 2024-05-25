<?php

namespace App\Services;

use App\Models\MonthlyExpense;

class MonthlyExpenseService
{
    public function update(
        MonthlyExpense $monthlyExpense,
        string $dueDate,
        int $amountInCents,
    ): MonthlyExpense {
        // TODO: Validation Rules
        // TODO: Policies
        $monthlyExpense->update([
            'due_date' => $dueDate,
            'amount_in_cents' => $amountInCents,
        ]);

        return $monthlyExpense;
    }

    public function delete(MonthlyExpense $monthlyExpense): void
    {
        $monthlyExpense->delete();
    }
}
