<?php

namespace App\Traits;

trait PaystubRecurrence
{
    public static array $RECURRENCE_RATES = [
        'weekly',
        'bi-weekly',
        'monthly',
        'bi-monthly',
    ];
}
