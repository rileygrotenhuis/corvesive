<?php

namespace App\Types;

trait PaystubRecurrence
{
    public static array $RECURRENCE_RATES = [
        'weekly',
        'bi-weekly',
        'monthly',
        'semi-monthly',
    ];
}
