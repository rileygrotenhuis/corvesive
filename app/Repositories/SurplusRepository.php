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
     * Returns the projected overall surplus
     * for a given user. It takes the current
     * surplus, adds the remaining amount to be
     * deposited, and then subtracts the remaining
     * amount to be paid.
     */
    public function projectedSurplus(): int
    {
        return $this->currentSurplus() + $this->remainingToDeposit() - $this->remainingToPay();
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

    /**
     * Returns the total amount remaining
     * to be deposited for the given month.
     */
    protected function remainingToDeposit(): int
    {
        return $this->user->monthlyPaystubs()
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->get()
            ->append(['is_deposited', 'amount_remaining'])
            ->where('is_deposited', false)
            ->sum('amount_remaining');
    }

    /**
     * Returns the total amount remaining
     * to be paid for the given month.
     */
    protected function remainingToPay(): int
    {
        return $this->user->monthlyExpenses()
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->get()
            ->append(['is_paid', 'amount_remaining'])
            ->where('is_paid', false)
            ->sum('amount_remaining');
    }
}
