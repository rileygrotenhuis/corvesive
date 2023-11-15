<?php

namespace App\Http\Resources\PayPeriods;

use App\Http\Resources\SavingResource;
use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodSavingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'pay_period' => $this->payPeriod(),
            'saving' => $this->savingAccount(),
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

    protected function savingAccount(): SavingResource|array
    {
        if (! $this->resource->relationLoaded('saving')) {
            return [
                'id' => $this->saving_id,
            ];
        }

        return SavingResource::make(
            $this->savingAccount
        );
    }
}
