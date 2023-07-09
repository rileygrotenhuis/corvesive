<?php

namespace App\Services;

use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\User;

class BudgetService
{
    public function createBudget(
        User $user,
        PayPeriod $payPeriod,
        string $name,
        int $amount
    ): Budget {
        $budget = new Budget();

        $budget->user_id = $user->id;
        $budget->pay_period_id = $payPeriod->id;
        $budget->name = $name;
        $budget->amount = $amount;
        $budget->remaining_balance = $amount;

        $budget->save();

        return $budget;
    }

    public function updateBudget(
        Budget $budget,
        string $name,
        int $amount
    ): Budget {
        $budget->name = $name;
        $budget->amount = $amount;
        $budget->remaining_balance = $amount;

        $budget->save();

        return $budget;
    }

    public function deleteBudget(Budget $budget): bool
    {
        return $budget->delete();
    }

    public function makePaymentOnBudget(Budget $budget, int $amount): Budget
    {
        $budget->remaining_balance = $budget->remaining_balance - $amount;
        $budget->save();

        return $budget;
    }
}
