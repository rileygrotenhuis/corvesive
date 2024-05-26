<?php

namespace App\Policies;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SavingPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Saving $saving): bool
    {
        return $user->id === $saving->user_id;
    }

    public function update(User $user, Saving $saving): bool
    {
        return $user->id === $saving->user_id;
    }

    public function delete(User $user, Saving $saving): bool
    {
        return $user->id === $saving->user_id;
    }
}
