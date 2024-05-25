<?php

namespace App\Types;

trait PaystubRecurrence
{
    /**
     * The different types of paystub recurrence
     * rates that a user can generate.
     */
    public static array $RECURRENCE_RATES = [
        'weekly',
        'bi-weekly',
        'monthly',
        'semi-monthly',
    ];
}
