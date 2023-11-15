<?php

namespace App\Policies;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SavingPolicy
{
    use HandlesAuthorization;

    public function user(User $user, Saving $saving): bool
    {
        return $user->id === $saving->user_id;
    }
}
