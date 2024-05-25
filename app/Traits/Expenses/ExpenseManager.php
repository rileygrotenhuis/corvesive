<?php

namespace App\Traits\Expenses;

use App\Events\Expenses\ExpenseCreated;
use App\Events\Expenses\ExpenseModified;
use App\Models\Expense;
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
        $expense = Expense::query()->create([
            'user_id' => $user->id,
            'type' => $type,
            'issuer' => $issuer,
            'name' => $name,
            'amount_in_cents' => $amountInCents,
            'due_day_of_month' => $dueDayOfMonth,
            'notes' => $notes,
        ]);

        event(new ExpenseCreated($expense));

        return $expense;
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
}
