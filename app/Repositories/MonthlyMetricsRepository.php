<?php

namespace App\Repositories;

use App\Models\User;

class MonthlyMetricsRepository
{
    public function __construct(protected User $user)
    {
    }

    public function getBillsTotal(): int
    {
        return $this->user
            ->bills()
            ->whereNull('deleted_at')
            ->sum('amount');
    }

    public function getBudgetsTotal(): int
    {
        return $this->user
            ->budgets()
            ->whereNull('deleted_at')
            ->sum('amount');
    }

    public function getPaystubsTotal(): int
    {
        return $this->user
            ->paystubs()
            ->whereNull('deleted_at')
            ->sum('amount');
    }
}
