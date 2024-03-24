<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodSavingsRequest;
use App\Models\PayPeriod;
use App\Models\PayPeriodSaving;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodSavingController extends Controller
{
    public function index(PayPeriod $payPeriod): Response
    {
        return Inertia::render('PayPeriods/Savings');
    }

    public function store(StorePayPeriodSavingsRequest $request, PayPeriod $payPeriod): RedirectResponse
    {
        PayPeriodSaving::updateOrCreate(
            [
                'pay_period_id' => $payPeriod->id,
                'saving_id' => $request->input('saving_id'),
            ],
            [
                'amount_in_cents' => $request->input('amount') * 100,
            ]
        );

        return to_route('pay-periods.settings');
    }
}
