<?php

namespace App\Http\v1\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodBudgetResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'pay_period' => $this->payPeriod(),
            'budget' => $this->budget(),
            'total_balance' => CurrencyUtil::formatCurrencyValues($this->total_balance),
            'remaining_balance' => CurrencyUtil::formatCurrencyValues($this->remaining_balance),
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

    protected function budget(): BudgetResource|array
    {
        if (! $this->resource->relationLoaded('budget')) {
            return [
                'id' => $this->budget_id,
            ];
        }

        return BudgetResource::make(
            $this->budget
        );
    }
}
