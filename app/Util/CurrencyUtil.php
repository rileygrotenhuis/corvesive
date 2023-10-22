<?php

namespace App\Util;

use Illuminate\Support\Collection;

class CurrencyUtil
{
    public static function formatCurrencyValues(int $amount): Collection
    {
        return collect([
            'raw' => $amount,
            'pretty' => '$'.number_format(($amount / 100), 2),
        ]);
    }
}
