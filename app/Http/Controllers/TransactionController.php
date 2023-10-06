<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function store(StoreTransactionRequest $request): TransactionResource
    {
        $transaction = (new TransactionService())
            ->createTransaction(
                $request->expense_type,
                $request->expense_id,
                $request->amount,
            );

        return new TransactionResource($transaction);
    }

    public function destroy(Transaction $transaction): JsonResponse
    {
        return response()->json('');
    }
}
