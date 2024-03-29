<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodPaystubsRequest;
use App\Models\PayPeriodPaystub;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodPaystubController extends Controller
{
    public function index(Request $request): Response
    {
        $currentPayPeriod = $request->user()->currentPayPeriod;

        $paystubs = PayPeriodPaystub::query()
            ->with('paystub')
            ->where('pay_period_id', $currentPayPeriod->id)
            ->get();

        return Inertia::render('PayPeriods/Paystubs/Index', [
            'paystubs' => $paystubs,
        ]);
    }

    public function settings(Request $request): Response|RedirectResponse
    {
        $paystubs = $request->user()->paystubs;

        if ($paystubs->isEmpty()) {
            return to_route('paystubs.create');
        }

        return Inertia::render('PayPeriods/Paystubs/Settings', [
            'paystubs' => $paystubs,
            'currentPaystubs' => $request->user()->currentPayPeriod->paystubs,
        ]);
    }

    public function store(StorePayPeriodPaystubsRequest $request): RedirectResponse
    {
        PayPeriodPaystub::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'pay_period_id' => $request->user()->currentPayPeriod->id,
                'paystub_id' => $request->input('paystub_id'),
            ],
            [
                'amount_in_cents' => $request->input('amount') * 100,
            ]
        );

        return to_route('pay-period-paystubs.settings');
    }

    public function destroy(PayPeriodPaystub $payPeriodPaystub): RedirectResponse
    {
        $payPeriodPaystub->delete();

        return to_route('pay-period-paystubs.settings');
    }
}
