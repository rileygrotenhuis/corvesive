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
        $transaction->amount = $payPeriodBill->amount;
        $transaction->save();

        $payPeriodBill->has_payed = 1;
        $payPeriodBill->save();

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

        $payPeriodBudget->remaining_balance = $payPeriodBudget->remaining_balance + $amount;
        $payPeriodBudget->save();

        return $transaction;
    }
}
