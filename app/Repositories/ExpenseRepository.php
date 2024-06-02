<?php

namespace App\Repositories;

use App\Models\User;
use App\Objects\ExpenseBanner;
use Illuminate\Support\Collection;

class ExpenseRepository
{
    public function __construct(protected User $user)
    {
        //
    }

    /**
     * Returns all of a user's monthly
     * expense records.
     */
    public function all(): Collection
    {
        $expenses = $this->user->expenses;

        return $expenses->map(function ($expense) {
            return new ExpenseBanner(
                $expense->id,
                $expense->type,
                $expense->issuer,
                $expense->name,
                $expense->amount,
                $expense->due_day,
                null,
                false,
                $expense->notes,
            );
        });
    }

    /**
     * Returns all of a user's monthly expenses
     * for the next 12 months grouped together
     * by the month.
     */
    public function monthly(): Collection
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->addMonths(11)->endOfMonth();

        $monthlyExpenses = $this->user->monthlyExpenses()
            ->selectRaw('*, DATE_FORMAT(due_date, \'%Y-%m\') as monthYear')
            ->with('expense')
            ->where('due_date', '>=', $startDate)
            ->where('due_date', '<=', $endDate)
            ->orderBy('due_date')
            ->get()
            ->append(['is_paid']);

        return $monthlyExpenses->map(function ($monthlyExpense) {
            return new ExpenseBanner(
                $monthlyExpense->id,
                $monthlyExpense->expense->type,
                $monthlyExpense->expense->issuer,
                $monthlyExpense->expense->name,
                $monthlyExpense->amount_remaining / 100,
                $monthlyExpense->due_day,
                $monthlyExpense->monthYear,
                $monthlyExpense->is_paid,
                $monthlyExpense->expense->notes,
            );
        });
    }
}
