<?php

namespace App\Services;

use App\Models\User;

class PayPeriodSavingManager
{
    public function __construct(protected User $user)
    {
    }
}
