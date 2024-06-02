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
     * Returns the total amount of expenses
     * for the given month.
     */
    public function totalExpenses(): int
    {
        return $this->user->monthlyExpenses()
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->sum('amount_in_cents');
    }

    /**
     * Returns the total amount of expenses
     * that have already been paid this month.
     */
    public function paidExpenses(): int
    {
        $monthlyExpenses = $this->user->monthlyExpenses()
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->pluck('id');

        return $this->user->payments()
            ->whereBetween('payment_date', [
                $this->today->startOfMonth()->toDateString(),
                $this->today->endOfMonth()->toDateString(),
            ])
            ->whereIn('monthly_expense_id', $monthlyExpenses)
            ->sum('amount_in_cents');
    }

    /**
     * Returns the total amount of paystubs
     * for the given month.
     */
    public function totalPaystubs(): int
    {
        return $this->user->monthlyPaystubs()
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->sum('amount_in_cents');
    }

    /**
     * Returns the total amount of paystubs
     * that have already been paid this month.
     */
    public function depositedPaystubs(): int
    {
        $monthlyPaystubs = $this->user->monthlyPaystubs()
            ->where('year', $this->year)
            ->where('month', $this->month)
            ->pluck('id');

        return $this->user->deposits()
            ->whereBetween('deposit_date', [
                $this->today->startOfMonth()->toDateString(),
                $this->today->endOfMonth()->toDateString(),
            ])
            ->whereIn('monthly_paystub_id', $monthlyPaystubs)
            ->sum('amount_in_cents');
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
