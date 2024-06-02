<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expenses\MonthlyExpensePaymentRequest;
use App\Models\MonthlyExpense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class MonthlyExpenseController extends Controller
{
    /**
     * Monthly Expenses - Show Page.
     */
    public function show(MonthlyExpense $monthlyExpense): Response
    {
        Gate::authorize('isOwner', $monthlyExpense);

        $monthlyExpense->append([
            'amount_paid',
            'amount_remaining',
            'is_paid',
        ]);

        $monthlyExpense->load('expense', 'payments');

        return inertia('Expenses/Due', [
            'monthlyExpense' => $monthlyExpense,
        ]);
    }

    /**
     * Modifies the amount value for a
     * given Monthly Expense record.
     */
    public function update(Request $request, MonthlyExpense $monthlyExpense): RedirectResponse
    {
        Gate::authorize('isOwner', $monthlyExpense);

        $request->validate([
            'amount_in_cents' => ['required', 'integer', 'min:1'],
        ]);

        $monthlyExpense->modify($request->input('amount_in_cents'));

        return to_route('monthly-expenses.show', $monthlyExpense);
    }

    /**
     * Reschedules a Monthly Expense.
     */
    public function reschedule(Request $request, MonthlyExpense $monthlyExpense): RedirectResponse
    {
        Gate::authorize('isOwner', $monthlyExpense);

        $request->validate([
            'due_date' => ['required', 'date'],
        ]);

        $monthlyExpense->reschedule($request->due_date);

        return to_route('monthly-expenses.show', $monthlyExpense);
    }

    /**
     * Unschedules a Monthly Expense.
     */
    public function unschedule(MonthlyExpense $monthlyExpense): RedirectResponse
    {
        Gate::authorize('isOwner', $monthlyExpense);

        $monthlyExpense->unschedule();

        return to_route('expenses.index');
    }

    /**
     * Make a payment for a Monthly Expense.
     */
    public function payment(
        MonthlyExpensePaymentRequest $request,
        MonthlyExpense $monthlyExpense
    ): RedirectResponse {
        Gate::authorize('isOwner', $monthlyExpense);

        $monthlyExpense->payment(
            $request->input('payment_date'),
            $request->input('amount_in_cents'),
            $request->input('notes'),
        );

        return to_route('monthly-expenses.show', $monthlyExpense);
    }
}
