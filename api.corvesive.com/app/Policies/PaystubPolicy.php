<?php

namespace App\Policies;

use App\Models\Paystub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaystubPolicy
{
    use HandlesAuthorization;

    public function user(User $user, Paystub $paystub): bool
    {
        return $user->id === $paystub->user_id;
    }
}
