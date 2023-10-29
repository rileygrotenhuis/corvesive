<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransactionController extends Controller
{
    public function accountTransactions(): AnonymousResourceCollection
    {
        return TransactionResource::collection(
            Transaction::with([
                'payPeriod',
                'payPeriodBill',
                'payPeriodBudget',
            ])
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at')
                ->get()
        );
    }

    public function payPeriodTransactions(PayPeriod $payPeriod): AnonymousResourceCollection
    {
        return TransactionResource::collection(
            Transaction::with([
                'payPeriod',
                'payPeriodBill',
                'payPeriodBudget',
            ])
                ->where('user_id', auth()->user()->id)
                ->where('pay_period_id', $payPeriod->id)
                ->orderBy('created_at')
                ->get()
        );
    }

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

    public function payPeriodDeposit(Request $request, PayPeriod $payPeriod): TransactionResource
    {
        $this->authorize('transaction', $payPeriod);

        $request->validate([
            'amount' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $transaction = (new TransactionService())
            ->makePayPeriodDeposit(
                $payPeriod,
                $request->amount,
                $request->notes
            );

        return new TransactionResource($transaction);
    }
}
