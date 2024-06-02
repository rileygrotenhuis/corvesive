<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class DateHelpers
{
    /**
     * Returns an array of month selection options
     * for the user's monthly paystubs and expenses.
     */
    public static function getMonthlySelectionOptions(): Collection
    {
        $months = collect();
        $currentMonth = now()->startOfMonth();
        for ($i = 0; $i < 12; $i++) {
            $months->push([
                'value' => $currentMonth->format('Y-m'),
                'label' => $currentMonth->format('M Y'),
            ]);
            $currentMonth->addMonth();
        }

        return $months;
    }
}
