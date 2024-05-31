<?php

namespace App\Http\Controllers;

use App\Models\MonthlyPaystub;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class MonthlyPaystubController extends Controller
{
    /**
     * Monthly Paystubs - Show Page.
     */
    public function show(MonthlyPaystub $monthlyPaystub): Response
    {
        $monthlyPaystub->append([
            'amount_deposited',
            'amount_remaining',
            'is_deposited',
        ]);

        $monthlyPaystub->load('paystub', 'deposits');

        return inertia('Paystubs/Due', [
            'monthlyPaystub' => $monthlyPaystub,
        ]);
    }

    /**
     * Modifies the amount value for a
     * given Monthly Paystub record.
     */
    public function update(Request $request, MonthlyPaystub $monthlyPaystub): RedirectResponse
    {
        $request->validate([
            'amount_in_cents' => ['required', 'integer', 'min:1'],
        ]);

        $monthlyPaystub->modify($request->input('amount_in_cents'));

        return to_route('monthly-paystubs.show', $monthlyPaystub);
    }

    /**
     * Reschedules a Monthly Paystub.
     */
    public function reschedule(Request $request, MonthlyPaystub $monthlyPaystub): RedirectResponse
    {
        $request->validate([
            'pay_day' => ['required', 'date'],
        ]);

        $monthlyPaystub->reschedule($request->input('pay_day'));

        return to_route('monthly-paystubs.show', $monthlyPaystub);
    }

    /**
     * Unschedules a Monthly Paystub.
     */
    public function unschedule(MonthlyPaystub $monthlyPaystub): RedirectResponse
    {
        $monthlyPaystub->unschedule();

        return to_route('paystubs.index');
    }

    /**
     * Deposit your Monthly Paystub.
     */
    public function deposit(Request $request, MonthlyPaystub $monthlyPaystub): RedirectResponse
    {
        $request->validate([
            'deposit_date' => ['required', 'date'],
            'amount_in_cents' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $monthlyPaystub->deposit(now()->format('Y-m-d'));

        return to_route('monthly-paystubs.show', $monthlyPaystub);
    }
}
