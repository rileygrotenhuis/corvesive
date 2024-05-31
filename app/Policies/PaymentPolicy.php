<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Returns whether the user is the
     * owner of the Payment.
     */
    public function isOwner(User $user, Payment $payment): bool
    {
        return $user->id === $payment->user_id;
    }
}
