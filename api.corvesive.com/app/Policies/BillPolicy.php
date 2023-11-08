<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    public function user(User $user, Bill $bill): bool
    {
        return $user->id === $bill->user_id;
    }
}
