<?php

namespace App\Traits\Expenses;

use App\Events\Expenses\ExpenseModified;
use App\Events\Expenses\ExpenseRescheduled;
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
        string $issuer,
        string $name,
        int $amountInCents,
        int $dueDayOfMonth,
        string $notes
    ): Expense {
        $amountChanged = $this->amount_in_cents !== $amountInCents;
        $dueDayChanged = $this->due_day_of_month !== $dueDayOfMonth;

        $this->update([
            'issuer' => $issuer,
            'name' => $name,
            'amount_in_cents' => $amountInCents,
            'due_day_of_month' => $dueDayOfMonth,
            'notes' => $notes,
        ]);

        /**
         * If ONLY amount value changed, modify all
         * future instances of this Expense
         */
        if ($amountChanged && ! $dueDayChanged) {
            event(new ExpenseModified($this));
        }

        /**
         * If the recurrence changed, un-schedule
         * and reschedule all future instances of this Expense
         */
        if ($dueDayChanged) {
            event(new ExpenseRescheduled($this));
        }

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
