<?php

namespace App\Policies;

use App\Models\MonthlySaving;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonthlySavingPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, MonthlySaving $monthlySaving): bool
    {
        return $user->id === $monthlySaving->user_id;
    }
}
