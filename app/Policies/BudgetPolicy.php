<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Budget $budget): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Budget $budget): bool
    {
        //
    }

    public function delete(User $user, Budget $budget): bool
    {
        //
    }

    public function restore(User $user, Budget $budget): bool
    {
        //
    }

    public function forceDelete(User $user, Budget $budget): bool
    {
        //
    }
}
