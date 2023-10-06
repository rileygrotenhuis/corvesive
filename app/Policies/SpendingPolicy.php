<?php

namespace App\Policies;

use App\Models\Spending;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpendingPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Spending $spending): bool
    {
        return $user->id === $spending->user_id;
    }

    public function update(User $user, Spending $spending): bool
    {
        return $user->id === $spending->user_id;
    }

    public function destroy(User $user, Spending $spending): bool
    {
        return $user->id === $spending->user_id;
    }
}
