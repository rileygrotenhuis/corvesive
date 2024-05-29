<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class PaystubRepository
{
    public function __construct(protected User $user)
    {
        //
    }

    /**
     * Returns all of a user's monthly paystub records.
     */
    public function all(): Collection
    {
        return $this->user->paystubs;
    }

    /**
     * Returns all of a user's monthly paystubs that are
     * being deposited within the next 7 days.
     */
    public function upcoming(): Collection
    {
        return $this->user
            ->monthlyPaystubs()
            ->with('paystub')
            ->where('pay_day', '>=', now()->format('Y-m-d'))
            ->where('pay_day', '<=', now()->addDays(7)->format('Y-m-d'))
            ->get();
    }

    /**
     * Returns all of a user's monthly paystubs that are
     * being deposited within the current calendar month.
     */
    public function thisMonth(): Collection
    {
        $today = now();

        return $this->user
            ->monthlyPaystubs()
            ->with('paystub')
            ->where('year', $today->year)
            ->where('month', $today->month)
            ->get();
    }

    /**
     * Returns all of a user's monthly paystubs that are
     * being deposited during next calendar month.
     */
    public function nextMonth(): Collection
    {
        $nextMonth = now()->addMonth();

        return $this->user
            ->monthlyPaystubs()
            ->with('paystub')
            ->where('year', $nextMonth->year)
            ->where('month', $nextMonth->month)
            ->get();
    }
}
