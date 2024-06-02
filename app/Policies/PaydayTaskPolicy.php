<?php

namespace App\Policies;

use App\Models\PaydayTask;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaydayTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Returns whether the user is the
     * owner of the Pay Day Task.
     */
    public function isOwner(User $user, PaydayTask $paydayTask): bool
    {
        return $user->id === $paydayTask->user_id;
    }
}
