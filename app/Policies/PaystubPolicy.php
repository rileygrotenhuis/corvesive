<?php

namespace App\Policies;

use App\Models\Paystub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaystubPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Paystub $paystub): bool
    {
        return $user->id === $paystub->user_id;
    }

    public function update(User $user, Paystub $paystub): bool
    {
        return $user->id === $paystub->user_id;
    }

    public function destroy(User $user, Paystub $paystub)
    {
        return $user->id === $paystub->user_id;
    }
}
