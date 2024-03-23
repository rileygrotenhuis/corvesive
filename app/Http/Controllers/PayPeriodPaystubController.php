<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodPaystubsRequest;
use App\Models\PayPeriodPaystub;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodPaystubController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('PayPeriods/Paystubs');
    }

    public function store(StorePayPeriodPaystubsRequest $request): RedirectResponse
    {
        foreach ($request->input('paystubs') as $paystub) {
            PayPeriodPaystub::updateOrCreate(
                [
                    'pay_period_id' => $request->user()->currentPayPeriod->id,
                    'saving_id' => $paystub['id'],
                ],
                [
                    'amount_in_cents' => $paystub['amount_in_cents'],
                ]
            );
        }

        return to_route('pay-periods.settings');
    }
}
