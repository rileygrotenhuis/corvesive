<?php

namespace App\Repositories;

use App\Models\User;

class MonthlyExpenseBreakdown
{
    public function __construct(protected User $user)
    {
    }

    public function getMonthlyExpenseBreakdown(): array
    {
        $bills = $this->getMonthlyBillsTotal() / 100;
        $budgets = $this->getMonthlyBudgetsTotal() / 100;
        $savings = $this->getMonthlySavingsTotal() / 100;

        return [
            'labels' => ['Bills', 'Budgets', 'Savings'],
            'data' => [
                'bills' => $bills,
                'budgets' => $budgets,
                'savings' => $savings,
            ],
            'card' => [
                'bills' => '$'.number_format($bills, 2),
                'budgets' => '$'.number_format($budgets, 2),
                'savings' => '$'.number_format($savings, 2),
                'total' => '$'.number_format($bills + $budgets + $savings, 2),
            ],
        ];
    }

    protected function getMonthlyBillsTotal(): int
    {
        return $this->user->monthlyBills->sum('amount_in_cents');
    }

    protected function getMonthlyBudgetsTotal(): int
    {
        return $this->user->monthlyBudgets()->sum('total_balance_in_cents');
    }

    protected function getMonthlySavingsTotal(): int
    {
        return $this->user->monthlySavings->sum('amount_in_cents');
    }
}
