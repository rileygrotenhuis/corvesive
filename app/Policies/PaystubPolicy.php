<?php

namespace App\Policies;

use App\Models\Paystub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaystubPolicy
{
    use HandlesAuthorization;

    /**
     * Determines whether the user is the owner
     * of the given Paystub.
     */
    public function isOwner(User $user, Paystub $paystub): bool
    {
        return $user->id === $paystub->user_id;
    }
}
