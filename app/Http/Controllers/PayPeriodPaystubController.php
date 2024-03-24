<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodPaystubsRequest;
use App\Models\PayPeriodPaystub;
use App\Services\PayPeriodBreakdownService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodPaystubController extends Controller
{
    public function index(Request $request): Response
    {
        $service = new PayPeriodBreakdownService($request->user()->currentPayPeriod);

        return Inertia::render('PayPeriods/Paystubs/Index', [
            'paystubs' => $service->getPaystubsBreakdown(),
        ]);
    }

    public function settings(Request $request): Response
    {
        return Inertia::render('PayPeriods/Paystubs/Settings', [
            'paystubs' => $request->user()->paystubs,
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
