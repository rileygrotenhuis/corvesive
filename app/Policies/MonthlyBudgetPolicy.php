<?php

namespace App\Policies;

use App\Models\MonthlyBudget;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonthlyBudgetPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, MonthlyBudget $monthlyBudget): bool
    {
        return $user->id === $monthlyBudget->user_id;
    }
}
