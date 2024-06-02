<?php

namespace App\Http\Controllers\Paystubs;

use App\Helpers\DateHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paystubs\MonthlyPaystubDepositRequest;
use App\Models\MonthlyPaystub;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class MonthlyPaystubController extends Controller
{
    /**
     * Monthly Paystubs - Show Page.
     */
    public function show(Request $request, MonthlyPaystub $monthlyPaystub): Response
    {
        Gate::authorize('isOwner', $monthlyPaystub);

        $monthlyPaystub->append([
            'amount_deposited',
            'amount_remaining',
            'is_deposited',
        ]);

        $monthlyPaystub->load('paystub', 'deposits');

        $repository = new ExpenseRepository($request->user());
        $upcomingExpenses = $repository->monthly()
            ->where('amount', '>', 0)
            ->groupBy('monthYear');

        $monthSelectionOptions = DateHelpers::getMonthlySelectionOptions();

        return inertia('Paystubs/Due', [
            'monthlyPaystub' => $monthlyPaystub,
            'paydayTasks' => $monthlyPaystub->paydayTasks->load('monthlyExpense.expense'),
            'upcomingExpenses' => $upcomingExpenses,
            'monthSelectionOptions' => $monthSelectionOptions,
        ]);
    }

    /**
     * Modifies the amount value for a
     * given Monthly Paystub record.
     */
    public function update(Request $request, MonthlyPaystub $monthlyPaystub): RedirectResponse
    {
        Gate::authorize('isOwner', $monthlyPaystub);

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
        Gate::authorize('isOwner', $monthlyPaystub);

        $monthlyPaystub->unschedule();

        return to_route('paystubs.index');
    }

    /**
     * Deposit your Monthly Paystub.
     */
    public function deposit(
        MonthlyPaystubDepositRequest $request,
        MonthlyPaystub $monthlyPaystub
    ): RedirectResponse {
        Gate::authorize('isOwner', $monthlyPaystub);

        $monthlyPaystub->deposit(
            $request->input('deposit_date'),
            $request->input('amount_in_cents'),
            $request->input('notes')
        );

        return to_route('monthly-paystubs.show', $monthlyPaystub);
    }
}
