<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayPeriodBillsRequest;
use App\Models\PayPeriodBill;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PayPeriodBillController extends Controller
{
    public function index(): Response
    {
        //
    }

    public function store(StorePayPeriodBillsRequest $request): RedirectResponse
    {
        foreach ($request->input('bills') as $bill) {
            PayPeriodBill::updateOrCreate(
                [
                    'pay_period_id' => $request->user()->currentPayPeriod->id,
                    'bill_id' => $bill['id'],
                ],
                [
                    'amount_in_cents' => $bill['amount'] * 100,
                    'due_date' => $bill['due_date'],
                ]
            );
        }

        return to_route('pay-periods.settings');
    }
}
