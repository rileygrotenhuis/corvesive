<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\User;

class ExpenseService
{
    public function create(
        User $user,
        string $issuer,
        string $name,
        int $amountInCents,
        int $dueDayOfMonth,
        string $notes,
    ): Expense {
        return Expense::query()->create([
            'user_id' => $user->id,
            'issuer' => $issuer,
            'name' => $name,
            'amount_in_cents' => $amountInCents,
            'due_day_of_month' => $dueDayOfMonth,
            'notes' => $notes,
        ]);
    }

    public function update(
        Expense $expense,
        string $issuer,
        string $name,
        int $amountInCents,
        int $dueDayOfMonth,
        string $notes
    ): Expense {
        $expense->update([
            'issuer' => $issuer,
            'name' => $name,
            'amount_in_cents' => $amountInCents,
            'due_day_of_month' => $dueDayOfMonth,
            'notes' => $notes,
        ]);

        return $expense;
    }

    public function delete(Expense $expense): void
    {
        $expense->delete();
    }
}
