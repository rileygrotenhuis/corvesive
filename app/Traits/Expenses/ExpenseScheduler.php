<?php

namespace App\Traits\Expenses;

use App\Models\Expense;
use App\Models\MonthlyExpense;
use Carbon\Carbon;

trait ExpenseScheduler
{
    /**
     * Schedules an Expense for a user on a specific date.
     */
    public function schedule(
        Expense $expense,
        int $year,
        int $month,
        string $dueDate,
        int $amountInCents
    ): MonthlyExpense {
        return MonthlyExpense::query()->create([
            'user_id' => $expense->user_id,
            'expense_id' => $expense->id,
            'year' => $year,
            'month' => $month,
            'due_date' => $dueDate,
            'amount_in_cents' => $amountInCents,
        ]);
    }

    /**
     * Schedules future Expenses for the next 12 months.
     */
    public function generateFutureExpenses(Expense $expense): void
    {
        for ($i = 0; $i < 12; $i++) {
            $dueDate = Carbon::now()->addMonths($i)->day($expense->due_day_of_month);

            $this->schedule(
                $expense,
                $dueDate->year,
                $dueDate->month,
                $dueDate,
                $expense->amount_in_cents
            );
        }
    }

    /**
     * Updates future Expenses with the new amount value.
     */
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

    /**
     * Reschedules all future instances of an Expense
     * to the new due day of the month.
     */
    public function rescheduleFutureExpenses(Expense $expense): void
    {
        $today = now()->format('Y-m-d');

        MonthlyExpense::query()
            ->where('expense_id', $expense->id)
            ->where('due_date', '>=', $today)
            ->each(function (MonthlyExpense $monthlyExpense) use ($expense) {
                $newDueDate = Carbon::parse($monthlyExpense->due_date)->day($expense->due_day_of_month);

                $monthlyExpense->due_date = $newDueDate;
                $monthlyExpense->save();
            });
    }
}
