<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardRepository
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
     * Returns the list of all transactions
     * for the given month.
     */
    public function allTransactions(): Collection
    {
        $payments = $this->allPayments();

        $deposits = $this->allDeposits();

        return $payments->merge($deposits)->sortBy('date')->values();
    }

    /**
     * Returns the list of all payments
     * for the given month.
     */
    protected function allPayments(): Collection
    {
        return $this->user->payments()
            ->select('*', 'payment_date as date')
            ->whereBetween('payment_date', [
                $this->today->startOfMonth()->toDateString(),
                $this->today->endOfMonth()->toDateString(),
            ])->get();
    }

    /**
     * Returns the list of all deposits
     * for the given month.
     */
    protected function allDeposits(): Collection
    {
        return $this->user->deposits()
            ->select('*', 'deposit_date as date')
            ->whereBetween('deposit_date', [
                $this->today->startOfMonth()->toDateString(),
                $this->today->endOfMonth()->toDateString(),
            ])->get();
    }
}
