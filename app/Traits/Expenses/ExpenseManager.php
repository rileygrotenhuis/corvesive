<?php

namespace App\Traits\Expenses;

use App\Models\Expense;
use App\Models\User;

trait ExpenseManager
{
    /**
     * Adds a new Expense for a user.
     */
    public static function add(
        User $user,
        string $type,
        ?string $issuer,
        string $name,
        int $amountInCents,
        int $dueDayOfMonth,
        ?string $notes = null,
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

    /**
     * Modifies an existing Expense.
     */
    public function modify(
        ?string $issuer,
        string $name,
        int $amountInCents,
        int $dueDayOfMonth,
        ?string $notes = null
    ): Expense {
        $this->update([
            'issuer' => $issuer,
            'name' => $name,
            'amount_in_cents' => $amountInCents,
            'due_day_of_month' => $dueDayOfMonth,
            'notes' => $notes,
        ]);

        return $this;
    }

    /**
     * Removes an existing Expense.
     */
    public function remove(): void
    {
        $this->delete();
    }
}
