<?php

namespace App\Traits\Expenses;

use App\Events\Expenses\ExpenseCreated;
use App\Events\Expenses\ExpenseModified;
use App\Models\Expense;
use App\Models\MonthlyExpense;
use App\Models\User;
use Carbon\Carbon;

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

    public function generateFutureExpenses(Expense $expense): void
    {
        for ($i = 0; $i < 12; $i++) {
            $dueDate = Carbon::now()->addMonths($i)->day($expense->due_day_of_month);

            $expense->schedule(
                $expense,
                $dueDate->year,
                $dueDate->month,
                $dueDate,
                $expense->amount_in_cents
            );
        }
    }

    public function modifyFutureExpenses(Expense $expense): void
    {
        $today = now()->format('Y-m-d');

        MonthlyExpense::query()
            ->where('expense_id', $expense->id)
            ->where('due_date', '>=', $today)
            ->update([
                'amount_in_cents' => $expense->amount_in_cents,
            ]);
    }
}
