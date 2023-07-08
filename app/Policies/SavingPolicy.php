<?php

namespace App\Policies;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SavingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Saving $saving): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Saving $saving): bool
    {
        //
    }

    public function delete(User $user, Saving $saving): bool
    {
        //
    }

    public function restore(User $user, Saving $saving): bool
    {
        //
    }

    public function forceDelete(User $user, Saving $saving): bool
    {
        //
    }
}
