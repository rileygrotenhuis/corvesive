<?php

namespace App\Policies;

use App\Models\MonthlyBill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonthlyBillPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, MonthlyBill $monthlyBill): bool
    {
        return $user->id === $monthlyBill->user_id;
    }
}
