<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodBudgetsRequest;
use App\Models\PayPeriodBudget;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PayPeriodBudgetController extends Controller
{
    public function index(): Response
    {
        //
    }

    public function store(StorePayPeriodBudgetsRequest $request): RedirectResponse
    {
        foreach ($request->input('budgets') as $budget) {
            PayPeriodBudget::udpateOrCreate(
                [
                    'pay_period_id' => $request->user()->currentPayPeriod->id,
                    'budget_id' => $budget['id'],
                ],
                [
                    'total_balance_in_cents' => $budget['total_balance'] * 100,
                ]
            );
        }

        return to_route('pay-periods.settings');
    }
}
