<?php

namespace App\Repositories;

use App\Models\User;

class RecurringMetricsRepository
{
    public function __construct(protected User $user)
    {
    }

    public function getPaystubsTotal(): int
    {
        return $this->user->paystubs()->sum('amount');
    }

    public function getBillsTotal(): int
    {
        return $this->user->bills()->sum('amount');
    }

    public function getBudgetsTotal(): int
    {
        return $this->user->budgets()->sum('amount');
    }

    public function getSavingsTotal(): int
    {
        return $this->user->savings()->sum('amount');
    }
}
