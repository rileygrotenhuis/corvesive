<?php

namespace App\Services;

use App\Models\User;

class PayPeriodBillManager
{
    public function __construct(protected User $user)
    {
    }
}
