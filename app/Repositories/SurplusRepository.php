<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;

class SurplusRepository
{
    protected Carbon $today;

    protected int $year;

    protected int $month;

    public function __construct(protected User $user)
    {
        $this->today = Carbon::today();
        $this->year = $this->today->year;
        $this->month = $this->today->month;
    }

    /**
     * Returns the current overall surplus
     * for a given user. Meaning the total
     * amount deposited minus the total amount
     * the user has paid.
     */
    public function currentSurplus(): int
    {
        return $this->totalDeposits() - $this->totalPayments();
    }

    /**
     * Returns the total amount of deposits
     * for a given user.
     */
    protected function totalDeposits(): int
    {
        return $this->user->deposits()->sum('amount_in_cents');
    }

    /**
     * Returns the total amount of payments
     * for a given user.
     */
    protected function totalPayments(): int
    {
        return $this->user->payments()->sum('amount_in_cents');
    }
}
