<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    /**
     * Refunds a payment that
     * a user has made.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $monthlyExpense = $payment->monthlyExpense;

        $payment->refund();

        return to_route('monthly-expenses.show', $monthlyExpense);
    }
}
