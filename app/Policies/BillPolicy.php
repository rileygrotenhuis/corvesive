<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Bill $bill): bool
    {
        return $user->id === $bill->user_id;
    }

    public function update(User $user, Bill $bill): bool
    {
        return $user->id === $bill->user_id;
    }

    public function delete(User $user, Bill $bill): bool
    {
        return $user->id === $bill->user_id;
    }
}
