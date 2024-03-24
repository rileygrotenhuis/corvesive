<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodBudgetsRequest;
use App\Models\PayPeriod;
use App\Models\PayPeriodBudget;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodBudgetController extends Controller
{
    public function index(PayPeriod $payPeriod): Response
    {
        return Inertia::render('PayPeriods/Budgets');
    }

    public function store(StorePayPeriodBudgetsRequest $request, PayPeriod $payPeriod): RedirectResponse
    {
        PayPeriodBudget::udpateOrCreate(
            [
                'pay_period_id' => $payPeriod->id,
                'budget_id' => $request->input('budget_id'),
            ],
            [
                'total_balance_in_cents' => $request->input('total_balance') * 100,
            ]
        );

        return to_route('pay-periods.settings');
    }
}
