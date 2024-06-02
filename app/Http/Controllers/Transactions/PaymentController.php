<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    /**
     * Creates a new surplus payment.
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $request->validate([
            'date' => ['required', 'date'],
            'amount_in_cents' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        Payment::payment(
            $request->user(),
            $request->input('date'),
            $request->input('amount_in_cents'),
            $request->input('notes')
        );

        return back();
    }

    /**
     * Refunds a payment that
     * a user has made.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        Gate::authorize('isOwner', $payment);

        $monthlyExpense = $payment->monthlyExpense;

        $payment->refund();

        return back();
    }
}
