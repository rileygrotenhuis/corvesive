<?php

namespace App\Traits\Expenses;

use App\Models\MonthlyExpense;
use Carbon\Carbon;

trait ExpenseScheduler
{
    /**
     * Schedules an Expense for a user on a specific date.
     */
    public function schedule(Carbon $dueDate, int $amountInCents): MonthlyExpense
    {
        return MonthlyExpense::query()->create([
            'user_id' => $this->user_id,
            'expense_id' => $this->id,
            'year' => $dueDate->year,
            'month' => $dueDate->month,
            'due_date' => $dueDate->format('Y-m-d'),
            'amount_in_cents' => $amountInCents,
        ]);
    }

    /**
     * Schedules future Expenses for the next 12 months.
     */
    public function generateFutureExpenses(): void
    {
        for ($i = 0; $i < 12; $i++) {
            $dueDate = Carbon::now()->addMonths($i)->day($this->due_day_of_month);

            $this->schedule(
                $dueDate,
                $this->amount_in_cents
            );
        }
    }

    /**
     * Updates future Expenses with the new amount value.
     */
    public function modifyFutureExpenses(): void
    {
        $today = now()->format('Y-m-d');

        MonthlyExpense::query()
            ->where('expense_id', $this->id)
            ->where('due_date', '>=', $today)
            ->update([
                'amount_in_cents' => $this->amount_in_cents,
            ]);
    }

    /**
     * Unschedules all future instances of an Expense.
     */
    public function unscheduleFutureExpenses(): void
    {
        $today = now()->format('Y-m-d');

        MonthlyExpense::query()
            ->where('expense_id', $this->id)
            ->where('due_date', '>=', $today)
            ->delete();
    }

    /**
     * Reschedules all future instances of an Expense
     * to the new due day of the month.
     */
    public function rescheduleFutureExpenses(): void
    {
        $today = now()->format('Y-m-d');

        MonthlyExpense::query()
            ->where('expense_id', $this->id)
            ->where('due_date', '>=', $today)
            ->each(function (MonthlyExpense $monthlyExpense) {
                $newDueDate = Carbon::parse($monthlyExpense->due_date)->day($this->due_day_of_month);

                $monthlyExpense->due_date = $newDueDate;
                $monthlyExpense->save();
            });
    }
}
