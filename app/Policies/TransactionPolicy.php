<?php

namespace App\Policies;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function user(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }
}
