<?php

namespace App\Services;

use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Transaction;

class TransactionService
{
    public function createTransaction(string $expenseType, int $expenseId, ?int $amount): Transaction
    {
        $transactionMethodMapping = [
            'budget' => 'createBudgetTransaction',
            'bill' => 'createBillTransaction',
        ];

        return $this->{$transactionMethodMapping[$expenseType]}($expenseId, $amount);
    }

    protected function createBudgetTransaction(int $budgetId, int $amount): Transaction
    {
        $payPeriodBudget = PayPeriodBudget::find($budgetId);
        $payPeriodBudget->remaining_balance = $payPeriodBudget->remaining_balance + $amount;
        $payPeriodBudget->save();

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->type = $amount > 0 ? 'deposit' : 'payment';
        $transaction->amount = $amount;
        $transaction->transactionable()->associate($payPeriodBudget);
        $transaction->save();

        return $transaction;
    }

    protected function createBillTransaction(int $billId): Transaction
    {
        $payPeriodBill = PayPeriodBill::find($billId);
        $payPeriodBill->has_payed = true;
        $payPeriodBill->save();

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->type = 'payment';
        $transaction->amount = $payPeriodBill->amount;
        $transaction->transactionable()->associate($payPeriodBill);
        $transaction->save();

        return $transaction;
    }
}
