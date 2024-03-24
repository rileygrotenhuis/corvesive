<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodBudgetsRequest;
use App\Models\PayPeriodBudget;
use App\Services\PayPeriodBreakdownService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodBudgetController extends Controller
{
    public function index(Request $request): Response
    {
        $service = new PayPeriodBreakdownService($request->user()->currentPayPeriod);

        return Inertia::render('PayPeriods/Budgets/Index', [
            'budgets' => $service->getBudgetsBreakdown(),
        ]);
    }

    public function settings(Request $request): Response
    {
        return Inertia::render('PayPeriods/Budgets/Settings', [
            'budgets' => $request->user()->monthlyBudgets,
            'currentBudgets' => request()->user()->currentPayPeriod->budgets,
        ]);
    }

    public function store(StorePayPeriodBudgetsRequest $request): RedirectResponse
    {
        PayPeriodBudget::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'pay_period_id' => $request->user()->currentPayPeriod->id,
                'budget_id' => $request->input('budget_id'),
            ],
            [
                'total_balance_in_cents' => $request->input('total_balance') * 100,
            ]
        );

        return to_route('pay-period-budgets.settings');
    }

    public function destroy(PayPeriodBudget $payPeriodBudget): RedirectResponse
    {
        $payPeriodBudget->delete();

        return to_route('pay-period-budgets.settings');
    }
}
