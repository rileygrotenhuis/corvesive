<?php

namespace App\Repositories;

use App\Models\User;

class DashboardRepository
{
    public function __construct(protected User $user)
    {
        //
    }

    /**
     * Returns the total amount
     * a user has deposited all-time.
     */
    public function totalDeposited(): int
    {
        return $this->user->deposits()->sum('amount_in_cents');
    }

    /**
     * Returns the total amount
     * a user has paid all-time
     */
    public function totalPaid(): int
    {
        return $this->user->payments()->sum('amount_in_cents');
    }
}
