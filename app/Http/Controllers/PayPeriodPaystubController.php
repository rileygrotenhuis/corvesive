<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodPaystubsRequest;
use App\Models\PayPeriod;
use App\Models\PayPeriodPaystub;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodPaystubController extends Controller
{
    public function index(PayPeriod $payPeriod): Response
    {
        return Inertia::render('PayPeriods/Paystubs');
    }

    public function store(StorePayPeriodPaystubsRequest $request, PayPeriod $payPeriod): RedirectResponse
    {
        PayPeriodPaystub::updateOrCreate(
            [
                'pay_period_id' => $payPeriod->id,
                'saving_id' => $request->input('paystub_id'),
            ],
            [
                'amount_in_cents' => $request->input('amount') * 100,
            ]
        );

        return to_route('pay-periods.settings');
    }
}
