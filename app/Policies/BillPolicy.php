<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Bill $bill): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Bill $bill): bool
    {
        //
    }

    public function delete(User $user, Bill $bill): bool
    {
        //
    }

    public function restore(User $user, Bill $bill): bool
    {
        //
    }

    public function forceDelete(User $user, Bill $bill): bool
    {
        //
    }
}
