<?php

namespace App\Policies;

use App\Models\CreditAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreditAccountPolicy
{
    use HandlesAuthorization;

    public function show(User $user, CreditAccount $creditAccount): bool
    {
        return $user->id === $creditAccount->user_id;
    }

    public function update(User $user, CreditAccount $creditAccount): bool
    {
        return $user->id === $creditAccount->user_id;
    }

    public function destroy(User $user, CreditAccount $creditAccount): bool
    {
        return $user->id === $creditAccount->user_id;
    }
}
