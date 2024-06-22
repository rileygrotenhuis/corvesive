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
     * Returns the total amount of surplus
     * payments for the given month.
     */
    public function totalSurplusPayments(): int
    {
        return $this->user->payments()
            ->whereNull('monthly_expense_id')
            ->whereBetween('payment_date', [
                $this->today->startOfMonth()->toDateString(),
                $this->today->endOfMonth()->toDateString(),
            ])->sum('amount_in_cents');
    }

    /**
     * Returns the total amount of surplus
     * deposits for the given month.
     */
    public function totalSurplusDeposits(): int
    {
        return $this->user->deposits()
            ->whereNull('monthly_paystub_id')
            ->whereBetween('deposit_date', [
                $this->today->startOfMonth()->toDateString(),
                $this->today->endOfMonth()->toDateString(),
            ])->sum('amount_in_cents');
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

        $combined = array_merge(
            $payments->toArray(),
            $deposits->toArray()
        );

        return collect($combined)->sortBy('date')->values()->take(10);
    }

    /**
     * Returns the list of all payments
     * for the given month.
     */
    protected function allPayments(): Collection
    {
        return $this->user->payments()
            ->select('*', 'payment_date as date')
            ->orderBy('payment_date', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Returns the list of all deposits
     * for the given month.
     */
    protected function allDeposits(): Collection
    {
        return $this->user->deposits()
            ->select('*', 'deposit_date as date')
            ->orderBy('deposit_date', 'desc')
            ->limit(10)
            ->get();
    }
}
