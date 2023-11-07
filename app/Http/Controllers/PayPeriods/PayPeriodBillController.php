<?php

namespace App\Http\Controllers\PayPeriods;

use App\Exceptions\AlreadyAttachedToPayPeriod;
use App\Http\Controllers\Controller;
use App\Http\Requests\PayPeriods\StorePayPeriodBillRequest;
use App\Http\Requests\PayPeriods\UpdatePayPeriodBillRequest;
use App\Http\Resources\PayPeriods\PayPeriodBillResource;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Models\Bill;
use App\Models\PayPeriod;
use App\Models\PayPeriodBill;
use App\Services\PayPeriods\PayPeriodBillService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PayPeriodBillController extends Controller
{
    public function __construct(protected PayPeriodBillService $payPeriodBillService)
    {
    }

    public function index(PayPeriod $payPeriod): AnonymousResourceCollection
    {
        return PayPeriodBillResource::collection(
            PayPeriodBill::with('bill')
                ->where('pay_period_id', $payPeriod->id)
                ->get()
        );
    }

    public function store(StorePayPeriodBillRequest $request, PayPeriod $payPeriod, Bill $bill): PayPeriodResource
    {
        $this->authorize('bill', [
            $payPeriod,
            $bill,
        ]);

        if ($this->payPeriodBillService->billIsAlreadyAttachedToPayPeriod($payPeriod, $bill)) {
            throw new AlreadyAttachedToPayPeriod();
        }

        $this->payPeriodBillService
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

        $this->payPeriodBillService
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

        $this->payPeriodBillService
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
