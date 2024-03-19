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
        foreach ($request->input('savings') as $saving) {
            PayPeriodSaving::updateOrCreate(
                [
                    'pay_period_id' => $request->user()->currentPayPeriod->id,
                    'saving_id' => $saving['id'],
                ],
                [
                    'amount_in_cents' => $saving['amount'] * 100,
                ]
            );
        }

        return to_route('pay-periods.settings');
    }
}
