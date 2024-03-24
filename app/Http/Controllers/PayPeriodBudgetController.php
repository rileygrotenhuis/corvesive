<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodBudgetsRequest;
use App\Models\PayPeriodBudget;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodBudgetController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('PayPeriods/Budgets');
    }

    public function store(StorePayPeriodBudgetsRequest $request): RedirectResponse
    {
        PayPeriodBudget::udpateOrCreate(
            [
                'user_id' => $request->user()->id,
                'pay_period_id' => $request->user()->currentPayPeriod->id,
                'budget_id' => $request->input('budget_id'),
            ],
            [
                'total_balance_in_cents' => $request->input('total_balance') * 100,
            ]
        );

        return to_route('pay-period-budgets.index');
    }

    public function destroy(PayPeriodBudget $payPeriodBudget): RedirectResponse
    {
        $payPeriodBudget->delete();

        return to_route('pay-period-budgets.index');
    }
}
