<?php

namespace App\Policies;

use App\Models\MonthlyPaystub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonthlyPaystubPolicy
{
    use HandlesAuthorization;

    /**
     * Returns whether the user is the owner
     * of the monthly paystub.
     */
    public function isOwner(User $user, MonthlyPaystub $monthlyPaystub)
    {
        return $user->id === $monthlyPaystub->user_id;
    }
}
