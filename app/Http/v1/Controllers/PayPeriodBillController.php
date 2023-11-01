<?php

namespace App\Http\v1\Controllers;

use App\Http\v1\Requests\StorePayPeriodBillRequest;
use App\Http\v1\Requests\UpdatePayPeriodBillRequest;
use App\Http\v1\Resources\PayPeriodResource;
use App\Models\Bill;
use App\Models\PayPeriod;
use App\Services\PayPeriodBillService;

class PayPeriodBillController extends Controller
{
    public function store(StorePayPeriodBillRequest $request, PayPeriod $payPeriod, Bill $bill): PayPeriodResource
    {
        $this->authorize('bill', [
            $payPeriod,
            $bill,
        ]);

        (new PayPeriodBillService())
            ->addBillToPayPeriod(
                $payPeriod->id,
                $bill->id,
                $request->amount,
                $request->due_date
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function update(UpdatePayPeriodBillRequest $request, PayPeriod $payPeriod, Bill $bill): PayPeriodResource
    {
        $this->authorize('bill', [
            $payPeriod,
            $bill,
        ]);

        (new PayPeriodBillService())
            ->updatePayPeriodBill(
                $payPeriod->id,
                $bill->id,
                $request->amount,
                $request->due_date,
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }

    public function destroy(PayPeriod $payPeriod, Bill $bill): PayPeriodResource
    {
        $this->authorize('bill', [
            $payPeriod,
            $bill,
        ]);

        (new PayPeriodBillService())
            ->removeBillFromPayPeriod(
                $payPeriod->id,
                $bill->id
            );

        return new PayPeriodResource(
            $payPeriod->load([
                'paystubs',
                'bills',
                'budgets',
            ])
        );
    }
}
