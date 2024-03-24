<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodSavingsRequest;
use App\Models\PayPeriodSaving;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodSavingController extends Controller
{
    public function index(Request $request): Response
    {
        $currentPayPeriod = $request->user()->currentPayPeriod;

        $savings = PayPeriodSaving::query()
            ->with('monthlySaving')
            ->where('pay_period_id', $currentPayPeriod->id)
            ->get();

        return Inertia::render('PayPeriods/Savings/Index', [
            'savings' => $savings,
        ]);
    }

    public function settings(Request $request): Response
    {
        return Inertia::render('PayPeriods/Savings/Settings', [
            'savings' => $request->user()->monthlySavings,
            'currentSavings' => $request->user()->currentPayPeriod->savings,
        ]);
    }

    public function store(StorePayPeriodSavingsRequest $request): RedirectResponse
    {
        PayPeriodSaving::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'pay_period_id' => $request->user()->currentPayPeriod->id,
                'saving_id' => $request->input('saving_id'),
            ],
            [
                'amount_in_cents' => $request->input('amount') * 100,
            ]
        );

        return to_route('pay-period-savings.settings');
    }

    public function destroy(PayPeriodSaving $payPeriodSaving): RedirectResponse
    {
        $payPeriodSaving->delete();

        return to_route('pay-period-savings.settings');
    }
}
