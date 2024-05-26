<?php

namespace App\Traits\Expenses;

use App\Events\Expenses\ExpenseCreated;
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

        /**
         * Schedules future instances of this Expense
         * for the next 12 months
         */
        event(new ExpenseCreated($expense));

        return $expense;
    }

    /**
     * Modifies an existing Expense.
     */
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

        /**
         * If ONLY amount value changed, modify all
         * future instances of this Expense
         */
        if ($amountChanged && ! $dueDayChanged) {
            event(new ExpenseModified($expense));
        }

        /**
         * If the recurrence changed, un-schedule
         * and reschedule all future instances of this Expense
         */
        if ($dueDayChanged) {
            event(new ExpenseRescheduled($expense));
        }

        return $expense;
    }

    /**
     * Removes an existing Expense.
     */
    public function remove(Expense $expense): void
    {
        $expense->delete();
    }
}
