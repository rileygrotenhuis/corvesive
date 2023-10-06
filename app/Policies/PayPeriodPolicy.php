<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayPeriodPolicy
{
    use HandlesAuthorization;

    public function show(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }

    public function update(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }

    public function destroy(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }

    public function spending(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }

    public function paystub(User $user, PayPeriod $payPeriod, Paystub $paystub): bool
    {
        return ($user->id === $payPeriod->user_id) && ($payPeriod->user_id === $paystub->user_id);
    }

    public function bill(User $user, PayPeriod $payPeriod, Bill $bill): bool
    {
        return $user->id === $payPeriod->user_id && ($payPeriod->user_id === $bill->user_id);
    }

    public function budget(User $user, PayPeriod $payPeriod, Budget $budget): bool
    {
        return $user->id === $payPeriod->user_id && ($payPeriod->user_id === $budget->user_id);
    }
}
