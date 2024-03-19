<?php

namespace App\Services;

use App\Models\User;

class ExpenseBreakdownService
{
    protected int $monthlyBillsTotal;

    protected int $monthlyBudgetsTotal;

    protected int $monthlySavingsTotal;

    public function __construct(protected User $user)
    {
        $this->monthlyBillsTotal = $this->getMonthlyBillsTotal();
        $this->monthlyBudgetsTotal = $this->getMonthlyBudgetsTotal();
        $this->monthlySavingsTotal = $this->getMonthlySavingsTotal();
    }

    public function getChartLabels(): array
    {
        return ['Bills', 'Budgets', 'Savings'];
    }

    public function getChartData(): array
    {
        return [
            [
                'label' => 'Monthly Expense Breakdown',
                'data' => [
                    $this->monthlyBillsTotal / 100,
                    $this->monthlyBudgetsTotal / 100,
                    $this->monthlySavingsTotal / 100,
                ],
            ],
        ];
    }

    public function getCardData(): array
    {
        return [
            'bills' => '$'.number_format($this->monthlyBillsTotal / 100, 2),
            'budgets' => '$'.number_format($this->monthlyBudgetsTotal / 100, 2),
            'savings' => '$'.number_format($this->monthlySavingsTotal / 100, 2),
            'total' => '$'.number_format(
                $this->monthlyBillsTotal + $this->monthlyBudgetsTotal + $this->monthlySavingsTotal / 100,
                2
            ),
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
