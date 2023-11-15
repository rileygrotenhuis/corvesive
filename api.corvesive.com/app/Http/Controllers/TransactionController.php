<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Models\PayPeriodBudget;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransactionController extends Controller
{
    public function __construct(protected TransactionService $transactionService)
    {
    }

    public function payPeriodTransactions(PayPeriod $payPeriod): AnonymousResourceCollection
    {
        $this->authorize('user', $payPeriod);

        return TransactionResource::collection(
            Transaction::with([
                'payPeriod',
                'payPeriodBill.bill',
                'payPeriodBudget.budget',
            ])
                ->where('user_id', auth()->user()->id)
                ->where('pay_period_id', $payPeriod->id)
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    public function payPeriodDeposits(PayPeriod $payPeriod): AnonymousResourceCollection
    {
        $this->authorize('user', $payPeriod);

        return TransactionResource::collection(
            Transaction::with(['payPeriod'])
                ->where('user_id', auth()->user()->id)
                ->where('pay_period_id', $payPeriod->id)
                ->whereNull('pay_period_bill_id')
                ->whereNull('pay_period_budget_id')
                ->where('type', 'deposit')
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    public function billTransaction(PayPeriod $payPeriod, PayPeriodBill $payPeriodBill): TransactionResource
    {
        $this->authorize('billTransaction', [
            $payPeriod,
            $payPeriodBill,
        ]);

        $transaction = $this->transactionService
            ->createBillTransaction(
                $payPeriod,
                $payPeriodBill
            );

        return new TransactionResource($transaction);
    }

    public function budgetTransaction(Request $request, PayPeriod $payPeriod, PayPeriodBudget $payPeriodBudget): TransactionResource
    {
        $this->authorize('budgetTransaction', [
            $payPeriod,
            $payPeriodBudget,
        ]);

        $request->validate([
            'amount' => 'required|integer',
        ]);

        $transaction = $this->transactionService
            ->createBudgetTransaction(
                $payPeriod,
                $payPeriodBudget,
                $request->amount
            );

        return new TransactionResource($transaction);
    }

    public function payPeriodDeposit(Request $request, PayPeriod $payPeriod): TransactionResource
    {
        $this->authorize('deposit', $payPeriod);

        $request->validate([
            'amount' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $transaction = $this->transactionService
            ->makePayPeriodDeposit(
                $payPeriod,
                $request->amount,
                $request->notes
            );

        return new TransactionResource($transaction);
    }

    public function update(Request $request, PayPeriod $payPeriod, Transaction $transaction): TransactionResource
    {
        $this->authorize('user', $transaction);

        $request->validate([
            'amount' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $transaction = $this->transactionService
            ->updateTransaction(
                $payPeriod,
                $transaction,
                $request->amount,
                $request->notes
            );

        return new TransactionResource($transaction);
    }

    public function destroy(PayPeriod $payPeriod, Transaction $transaction): JsonResponse
    {
        $this->authorize('user', $transaction);

        $this->transactionService->deleteTransaction($transaction);

        return response()->json('', 204);
    }
}
