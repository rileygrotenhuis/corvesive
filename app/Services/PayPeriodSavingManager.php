<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\User;

class PayPeriodSavingManager
{
    public function __construct(
        protected User $user,
        protected PayPeriod $payPeriod
    ) {
    }
}
