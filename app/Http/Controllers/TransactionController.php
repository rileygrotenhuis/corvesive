<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function billTransaction(PayPeriod $payPeriod, PayPeriodBill $payPeriodBill): TransactionResource
    {
        $this->authorize('transaction', $payPeriod);

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->pay_period_id = $payPeriod->id;
        $transaction->pay_period_bill_id = $payPeriodBill->id;
        $transaction->type = 'payment';
        $transaction->amount = $payPeriodBill->amount;
        $transaction->save();

        $payPeriodBill->has_payed = 1;
        $payPeriodBill->save();

        return new TransactionResource($transaction);
    }

    public function budgetTransaction(Request $request, PayPeriod $payPeriod, PayPeriodBudget $payPeriodBudget): TransactionResource
    {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        return new TransactionResource([]);
    }
}
