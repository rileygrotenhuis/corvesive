<?php

namespace App\Repositories;

use App\Models\User;
use App\Objects\PaystubBanner;
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
        $paystubs = $this->user->paystubs;

        return $paystubs->map(function ($paystub) {
            return new PaystubBanner(
                $paystub->id,
                $paystub->issuer,
                $paystub->recurrence,
                $paystub->amount,
                null,
                null,
                false,
                $paystub->notes
            );
        });
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

        $monthlyPaystubs = $this->user->monthlyPaystubs()
            ->selectRaw('*, DATE_FORMAT(pay_day, \'%Y-%m\') as monthYear')
            ->with('paystub')
            ->where('pay_day', '>=', $startDate)
            ->where('pay_day', '<=', $endDate)
            ->orderBy('pay_day')
            ->get()
            ->append(['is_deposited']);

        return $monthlyPaystubs->map(function ($monthlyPaystub) {
            return new PaystubBanner(
                $monthlyPaystub->id,
                $monthlyPaystub->paystub->issuer,
                $monthlyPaystub->paystub->recurrence,
                $monthlyPaystub->amount,
                $monthlyPaystub->pay_date,
                $monthlyPaystub->monthYear,
                $monthlyPaystub->is_deposited,
                $monthlyPaystub->paystub->notes,
            );
        });
    }
}
