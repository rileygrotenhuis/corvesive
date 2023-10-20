<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Transaction;

class TransactionService
{
    public function createBillTransaction(
        PayPeriod $payPeriod,
        PayPeriodBill $payPeriodBill
    ): Transaction {
        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->pay_period_id = $payPeriod->id;
        $transaction->pay_period_bill_id = $payPeriodBill->id;
        $transaction->type = 'payment';
        $transaction->amount = $payPeriodBill->amount * -1;
        $transaction->save();

        $this->markPayPeriodBillAsPayed($payPeriodBill);

        return $transaction;
    }

    public function createBudgetTransaction(
        PayPeriod $payPeriod,
        PayPeriodBudget $payPeriodBudget,
        int $amount
    ): Transaction {
        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->pay_period_id = $payPeriod->id;
        $transaction->pay_period_budget_id = $payPeriodBudget->id;
        $transaction->type = $amount >= 0 ? 'deposit' : 'payment';
        $transaction->amount = $amount;
        $transaction->save();

        $this->updatePayPeriodBudgetBalance($payPeriodBudget, $amount);

        return $transaction;
    }

    public function makePayPeriodDeposit(
        PayPeriod $payPeriod,
        int $amount
    ): Transaction
    {
        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->pay_period_id = $payPeriod->id;
        $transaction->type = 'deposit';
        $transaction->amount = $amount;
        $transaction->save();

        $payPeriod->total_income = $payPeriod->total_income + $amount;
        $payPeriod->save();

        return $transaction;
    }

    protected function markPayPeriodBillAsPayed(PayPeriodBill $payPeriodBill): void
    {
        $payPeriodBill->has_payed = 1;
        $payPeriodBill->save();
    }

    protected function updatePayPeriodBudgetBalance(PayPeriodBudget $payPeriodBudget, int $amount): void
    {
        $payPeriodBudget->remaining_balance = $payPeriodBudget->remaining_balance + $amount;
        $payPeriodBudget->save();
    }
}
