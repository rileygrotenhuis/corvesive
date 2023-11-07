<?php

namespace App\Http\Resources\PayPeriods;

use App\Http\Resources\PaystubResource;
use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodPaystubResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'pay_period' => $this->payPeriod(),
            'paystub' => $this->paystub(),
            'amount' => CurrencyUtil::formatCurrencyValues($this->amount),
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

    protected function paystub(): PaystubResource|array
    {
        if (! $this->resource->relationLoaded('paystub')) {
            return [
                'id' => $this->paystub_id,
            ];
        }

        return PaystubResource::make(
            $this->paystub
        );
    }
}
