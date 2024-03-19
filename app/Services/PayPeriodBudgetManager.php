<?php

namespace App\Services;

use App\Models\User;

class PayPeriodBudgetManager
{
    public function __construct(protected User $user)
    {
    }
}
