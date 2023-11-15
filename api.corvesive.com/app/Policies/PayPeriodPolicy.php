<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Paystub;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayPeriodPolicy
{
    use HandlesAuthorization;

    public function user(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }

    public function paystub(User $user, PayPeriod $payPeriod, Paystub $paystub): bool
    {
        return ($user->id === $payPeriod->user_id) && ($payPeriod->user_id === $paystub->user_id);
    }

    public function bill(User $user, PayPeriod $payPeriod, Bill $bill): bool
    {
        return $user->id === $payPeriod->user_id && ($payPeriod->user_id === $bill->user_id);
    }

    public function budget(User $user, PayPeriod $payPeriod, Budget $budget): bool
    {
        return $user->id === $payPeriod->user_id && ($payPeriod->user_id === $budget->user_id);
    }

    public function saving(User $user, PayPeriod $payPeriod, Saving $saving): bool
    {
        return $user->id === $payPeriod->user_id && ($payPeriod->user_id === $saving->user_id);
    }

    public function billTransaction(User $user, PayPeriod $payPeriod, PayPeriodBill $payPeriodBill): bool
    {
        return ($user->id === $payPeriod->user_id) && ($payPeriod->id === $payPeriodBill->pay_period_id);
    }

    public function budgetTransaction(User $user, PayPeriod $payPeriod, PayPeriodBudget $payPeriodBudget): bool
    {
        return ($user->id === $payPeriod->user_id) && ($payPeriod->id === $payPeriodBudget->pay_period_id);
    }

    public function deposit(User $user, PayPeriod $payPeriod): bool
    {
        return $user->id === $payPeriod->user_id;
    }
}
