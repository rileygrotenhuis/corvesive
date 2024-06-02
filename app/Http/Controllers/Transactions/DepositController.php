<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Deposit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class DepositController extends Controller
{
    /**
     * Creates a new surplus deposit.
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        Deposit::makeDeposit(
            $request->user(),
            $request->input('date'),
            $request->input('amount_in_cents'),
            $request->input('notes')
        );

        return back();
    }

    /**
     * Refunds a deposit that
     * a user has made.
     */
    public function destroy(Deposit $deposit): RedirectResponse
    {
        Gate::authorize('isOwner', $deposit);

        $monthlyPaystub = $deposit->monthlyPaystub;

        $deposit->refund();

        return back();
    }
}
