<?php

namespace App\Repositories;

use App\Models\User;
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
        return $this->user->expenses;
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

        return $this->user->monthlyExpenses()
            ->selectRaw('*, DATE_FORMAT(due_date, \'%m-%Y\') as monthYear')
            ->with('expense')
            ->where('due_date', '>=', $startDate)
            ->where('due_date', '<=', $endDate)
            ->orderBy('due_date')
            ->get()
            ->groupBy('monthYear')
            ->append(['is_paid']);
    }

    /**
     * Returns an array of month selection options
     * for the user's monthly expenses.
     */
    public function getMonthlySelectionOptions(Collection $monthlyExpenses): Collection
    {
        $months = collect();
        $currentMonth = now()->startOfMonth();
        for ($i = 0; $i < 12; $i++) {
            $months->push([
                'value' => $currentMonth->format('m-Y'),
                'label' => $currentMonth->format('F Y'),
            ]);
            $currentMonth->addMonth();
        }

        return $months;
    }
}
