<?php

namespace App\Traits\Paystubs;

use App\Models\MonthlyPaystub;
use Carbon\Carbon;

trait PaystubScheduler
{
    /**
     * Schedules a Paystub for a user on a specific date.
     */
    public function schedule(Carbon $payDay, int $amountInCents): MonthlyPaystub
    {
        return MonthlyPaystub::query()->create([
            'user_id' => $this->user_id,
            'paystub_id' => $this->id,
            'year' => $payDay->year,
            'month' => $payDay->month,
            'pay_day' => $payDay->format('Y-m-d'),
            'amount_in_cents' => $amountInCents,
        ]);
    }

    /**
     * Schedules future Paystubs for the next 12 months.
     */
    public function generateFutureExpenses(): void
    {
        if (in_array($this->recurrence_rate, ['monthly', 'semi-monthly'])) {
            $this->generateMonthlyExpenses($this->recurrence_rate === 'semi-monthly');
        }

        if (in_array($this->recurrence_rate, ['weekly', 'bi-weekly'])) {
            $this->generateWeeklyExpenses($this->recurrence_rate === 'bi-weekly');
        }
    }

    /**
     * Generates monthly, or semi-monthly expenses for the next 12 months.
     */
    protected function generateMonthlyExpenses(bool $semiMonthly = false): void
    {
        for ($i = 0; $i < 12; $i++) {
            $payDate = Carbon::now()->addMonths($i)->day((int) $this->recurrence_interval_one);

            $this->schedule(
                $payDate,
                $this->amount_in_cents,
            );

            if ($semiMonthly) {
                $payDate = Carbon::now()->addMonths($i)->day((int) $this->recurrence_interval_two);

                $this->schedule(
                    $payDate,
                    $this->amount_in_cents,
                );
            }
        }
    }

    /**
     * Generates weekly, or bi-weekly expenses for the next 12 months.
     */
    protected function generateWeeklyExpenses(bool $biWeekly = false): void
    {
        $interval = $biWeekly ? 2 : 1;

        $startOfWeek = Carbon::now()->startOfWeek();

        for ($i = 0; $i < 52; $i += $interval) {
            $payDate = $startOfWeek->copy()->addWeeks($i)->addDays((int) $this->recurrence_interval_one);

            $this->schedule(
                $payDate,
                $this->amount_in_cents
            );
        }
    }

    /**
     * Updates future Paystubs with the new amount value.
     */
    public function modifyFuturePaystubs(): void
    {
        $today = now()->format('Y-m-d');

        MonthlyPaystub::query()
            ->where('paystub_id', $this->id)
            ->where('pay_day', '>=', $today)
            ->update([
                'amount_in_cents' => $this->amount_in_cents,
            ]);
    }

    /**
     * Unschedules all future instances of a Paystub.
     */
    public function unscheduleFuturePaystubs(): void
    {
        $today = now()->format('Y-m-d');

        MonthlyPaystub::query()
            ->where('paystub_id', $this->id)
            ->where('pay_day', '>=', $today)
            ->delete();
    }
}
