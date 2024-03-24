<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodSavingsRequest;
use App\Models\PayPeriodSaving;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PayPeriodSavingController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('PayPeriods/Savings');
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

        return to_route('pay-period-savings.index');
    }

    public function destroy(PayPeriodSaving $payPeriodSaving): RedirectResponse
    {
        $payPeriodSaving->delete();

        return to_route('pay-period-savings.index');
    }
}
