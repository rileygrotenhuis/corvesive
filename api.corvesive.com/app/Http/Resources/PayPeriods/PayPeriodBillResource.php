<?php

namespace App\Http\Resources\PayPeriods;

use App\Http\Resources\BillResource;
use App\Services\PayPeriods\PayPeriodBillService;
use App\Util\CurrencyUtil;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodBillResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'pay_period' => $this->payPeriod(),
            'bill' => $this->bill(),
            'amount' => CurrencyUtil::formatCurrencyValues($this->amount),
            'dates' => [
                'due' => [
                    'raw' => $this->due_date,
                    'pretty' => [
                        'full' => Carbon::parse($this->due_date)->format('F j, Y'),
                        'short' => Carbon::parse($this->due_date)->format('n/j/y'),
                        'day' => Carbon::parse($this->due_date)->format('jS'),
                        'input' => Carbon::parse($this->due_date)->format('Y-m-d'),
                    ],
                ],
            ],
            'has_payed' => $this->has_payed,
            'status' => resolve(PayPeriodBillService::class)
                ->getPayPeriodBillStatus(
                    $this->has_payed,
                    $this->due_date
                ),
        ];
    }

    protected function payPeriod(): PayPeriodResource|array
    {
        if (! $this->resource->relationLoaded('payPeriod')) {
            return [
                'id' => $this->pay_period_id,
            ];
        }

        return PayPeriodResource::make(
            $this->payPeriod
        );
    }

    protected function bill(): BillResource|array
    {
        if (! $this->resource->relationLoaded('bill')) {
            return [
                'id' => $this->bill_id,
            ];
        }

        return BillResource::make(
            $this->bill
        );
    }
}
