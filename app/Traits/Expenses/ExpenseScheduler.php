<?php

namespace App\Traits\Expenses;

use App\Models\Expense;
use App\Models\MonthlyExpense;
use Carbon\Carbon;

trait ExpenseScheduler
{
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
