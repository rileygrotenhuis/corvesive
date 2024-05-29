<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
     * Returns all of a user's monthly paystubs
     * for the next 12 months grouped together
     * by the month.
     */
    public function monthly(): Collection
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->addMonths(11)->endOfMonth();

        return $this->user->monthlyPaystubs()
            ->selectRaw('*, DATE_FORMAT(pay_day, \'%m-%Y\') as monthYear')
            ->with('paystub')
            ->where('pay_day', '>=', $startDate)
            ->where('pay_day', '<=', $endDate)
            ->get()
            ->groupBy('monthYear');
    }

    /**
     * Returns an array of month selection options
     * for the user's monthly paystubs.
     */
    public function getMonthlySelectionOptions(Collection $monthlyPaystubs): Collection
    {
        return $monthlyPaystubs->keys()->map(function ($date) {
            $month = Str::before($date, '-');
            $year = Str::after($date, '-');

            return [
                'value' => $date,
                'label' => Carbon::createFromDate($year, $month)->format('F Y'),
            ];
        });
    }
}
