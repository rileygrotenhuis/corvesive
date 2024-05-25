<?php

namespace App\Traits\Expenses;

use App\Events\ExpenseModified;
use App\Models\Expense;
use App\Models\MonthlyExpense;
use App\Models\User;

trait ExpenseManager
{
    public static function add(
        User $user,
        string $type,
        string $issuer,
        string $name,
        int $amountInCents,
        int $dueDayOfMonth,
        string $notes,
    ): Expense {
        return Expense::query()->create([
            'user_id' => $user->id,
            'type' => $type,
            'issuer' => $issuer,
            'name' => $name,
            'amount_in_cents' => $amountInCents,
            'due_day_of_month' => $dueDayOfMonth,
            'notes' => $notes,
        ]);
    }

    public function modify(
        Expense $expense,
        string $issuer,
        string $name,
        int $amountInCents,
        int $dueDayOfMonth,
        string $notes
    ): Expense {
        $amountChanged = $expense->amount_in_cents !== $amountInCents;
        $dueDayChanged = $expense->due_day_of_month !== $dueDayOfMonth;

        $expense->update([
            'issuer' => $issuer,
            'name' => $name,
            'amount_in_cents' => $amountInCents,
            'due_day_of_month' => $dueDayOfMonth,
            'notes' => $notes,
        ]);

        if ($amountChanged) {
            event(new ExpenseModified($expense));
        }

        return $expense;
    }

    public function remove(Expense $expense): void
    {
        $expense->delete();
    }

    public function schedule(
        Expense $expense,
        int $year,
        int $month,
        string $dueDate,
        int $amountInCents
    ): MonthlyExpense {
        // TODO: Validation Rules
        // TODO: Policies

        return MonthlyExpense::query()->create([
            'user_id' => $expense->user_id,
            'expense_id' => $expense->id,
            'year' => $year,
            'month' => $month,
            'due_date' => $dueDate,
            'amount_in_cents' => $amountInCents,
        ]);
    }
}
