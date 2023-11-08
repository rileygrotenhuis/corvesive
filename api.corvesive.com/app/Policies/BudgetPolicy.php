<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetPolicy
{
    use HandlesAuthorization;

    public function user(User $user, Budget $budget): bool
    {
        return $user->id === $budget->user_id;
    }
}
