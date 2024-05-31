<?php

namespace App\Policies;

use App\Models\MonthlyExpense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonthlyExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Returns whether the user is the owner
     * of the monthly expense.
     */
    public function isOwner(User $user, MonthlyExpense $monthlyExpense)
    {
        return $user->id === $monthlyExpense->user_id;
    }
}
