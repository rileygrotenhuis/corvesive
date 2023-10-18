<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function billTransaction(PayPeriod $payPeriod, PayPeriodBill $payPeriodBill): TransactionResource
    {
        $this->authorize('transaction', $payPeriod);

        $transaction = (new TransactionService())
            ->createBillTransaction(
                $payPeriod,
                $payPeriodBill
            );

        return new TransactionResource($transaction);
    }

    public function budgetTransaction(Request $request, PayPeriod $payPeriod, PayPeriodBudget $payPeriodBudget): TransactionResource
    {
        $this->authorize('transaction', $payPeriod);

        $request->validate([
            'amount' => 'required|integer',
        ]);

        $transaction = (new TransactionService())
            ->createBudgetTransaction(
                $payPeriod,
                $payPeriodBudget,
                $request->amount
            );

        return new TransactionResource($transaction);
    }
}
