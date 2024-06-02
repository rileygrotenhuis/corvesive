<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
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
