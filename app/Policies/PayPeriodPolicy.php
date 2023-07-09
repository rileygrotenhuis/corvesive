<?php

namespace App\Policies;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayPeriodPolicy
{
    use HandlesAuthorization;

    public function update(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }

    public function delete(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }
}
