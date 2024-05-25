<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\MonthlyExpense;
use App\Models\User;

class MonthlyExpenseService
{
    public function create(
        User $user,
        Expense $expense,
        int $year,
        int $month,
        string $dueDate,
        int $amountInCents,
    ): MonthlyExpense {
        // TODO: Validation Rules
        // TODO: Policies
        return MonthlyExpense::query()->create([
            'user_id' => $user->id,
            'expense_id' => $expense->id,
            'year' => $year,
            'month' => $month,
            'due_date' => $dueDate,
            'amount_in_cents' => $amountInCents,
        ]);
    }

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
