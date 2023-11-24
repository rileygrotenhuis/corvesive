<?php

namespace App\Util;

use Illuminate\Support\Collection;

class CurrencyUtil
{
    public static function formatCurrencyValues(?int $amount): Collection
    {
        if ($amount) {
            return collect([
                'raw' => $amount,
                'pretty' => '$'.number_format(($amount / 100), 2),
                'input' => number_format(($amount / 100), 2),
            ]);
        }

        return collect([
            'raw' => 0,
            'pretty' => '$0.00',
            'input' => 0,
        ]);
    }
}
