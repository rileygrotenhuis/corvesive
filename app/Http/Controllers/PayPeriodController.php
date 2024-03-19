<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodRequest;
use App\Models\PayPeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('PayPeriods/Index');
    }

    public function create(): Response
    {
        return Inertia::render('PayPeriods/Create');
    }

    public function store(StorePayPeriodRequest $request): RedirectResponse
    {
        $payPeriod = $request->user()->payPeriods()->create([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        $request->user()->update([
            'current_pay_period_id' => $payPeriod->id,
        ]);

        return to_route('pay-periods.index');
    }

    public function settings(): Response
    {
        return Inertia::render('PayPeriods/Settings');
    }

    public function current(Request $request, PayPeriod $payPeriod): RedirectResponse
    {
        $request->user()->update([
            'current_pay_period_id' => $payPeriod->id,
        ]);

        return to_route('pay-periods.index');
    }
}
