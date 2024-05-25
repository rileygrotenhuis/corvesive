<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyPaystub;
use App\Models\Paystub;
use Carbon\Carbon;

trait PaystubScheduler
{
    public function schedule(
        Paystub $paystub,
        int $year,
        int $month,
        string $payDay,
        int $amountInCents
    ): MonthlyPaystub {
        // TODO: Validation Rules
        // TODO: Policies

        return MonthlyPaystub::query()->create([
            'user_id' => $paystub->user_id,
            'paystub_id' => $paystub->id,
            'year' => $year,
            'month' => $month,
            'pay_day' => $payDay,
            'amount_in_cents' => $amountInCents,
        ]);
    }

    public function generateFutureExpenses(Paystub $paystub): void
    {
        if (in_array($paystub->recurrence_rate, ['monthly', 'semi-monthly'])) {
            $this->generateMonthlyExpenses(
                $paystub,
                $paystub->recurrence_rate === 'semi-monthly'
            );
        }

        if (in_array($paystub->recurrence_rate, ['weekly', 'bi-weekly'])) {
            $this->generateWeeklyExpenses(
                $paystub,
                $paystub->recurrence_rate === 'bi-weekly'
            );
        }
    }

    protected function generateMonthlyExpenses(
        Paystub $paystub,
        bool $semiMonthly = false
    ): void {
        for ($i = 0; $i < 12; $i++) {
            $payDate = Carbon::now()->addMonths($i)->day($paystub->recurrence_interval_one);

            $this->schedule(
                $paystub,
                $payDate->year,
                $payDate->month,
                $payDate,
                $paystub->amount_in_cents,
            );

            if ($semiMonthly) {
                $payDate = Carbon::now()->addMonths($i)->day($paystub->recurrence_interval_two);

                $this->schedule(
                    $paystub,
                    $payDate->year,
                    $payDate->month,
                    $payDate,
                    $paystub->amount_in_cents,
                );
            }
        }
    }

    protected function generateWeeklyExpenses(
        Paystub $paystub,
        bool $biWeekly = false
    ): void {
        $interval = $biWeekly ? 2 : 1;

        for ($i = 0; $i < 52; $i += $interval) {
            $payDate = Carbon::now()->addWeeks($i)->next($paystub->recurrence_interval_one);

            $this->schedule(
                $paystub,
                $payDate->year,
                $payDate->month,
                $payDate,
                $paystub->amount_in_cents
            );
        }
    }

    public function modifyFuturePaystubs(Paystub $paystub): void
    {
        $today = now()->format('Y-m-d');

        MonthlyPaystub::query()
            ->where('paystub_id', $paystub->id)
            ->where('pay_date', '>=', $today)
            ->update([
                'amount_in_cents' => $paystub->amount_in_cents,
            ]);
    }
}
