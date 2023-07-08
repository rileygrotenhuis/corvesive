<?php

namespace App\Policies;

use App\Models\PayPeriod;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayPeriodPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, PayPeriod $payPeriod): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, PayPeriod $payPeriod): bool
    {
        //
    }

    public function delete(User $user, PayPeriod $payPeriod): bool
    {
        //
    }

    public function restore(User $user, PayPeriod $payPeriod): bool
    {
        //
    }

    public function forceDelete(User $user, PayPeriod $payPeriod): bool
    {
        //
    }
}
