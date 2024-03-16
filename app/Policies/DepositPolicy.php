<?php

namespace App\Policies;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepositPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, Deposit $deposit): bool
    {
        return $user->id === $deposit->user_id;
    }
}
