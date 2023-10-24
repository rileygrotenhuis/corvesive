<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodMetricResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user' => $this->user(),
            'pay_period' => $this->payPeriod(),
            'bill_metrics' => [
                'total_payed' => [],
                'total_unpayed' => [],
                'total' => [],
            ],
            'budget_metrics' => [
                'total_balance' => [],
                'remaining_balance' => []
            ],
            'income_metrics' => [
                'total_income' => [],
                'paystubs_total' => [],
            ],
            'transaction_metrics' => [
                'total_spent' => [
                    'bills' => [],
                    'budgets' => [],
                    'total' => [],
                ],
                'total_deposited' => [],
            ],
            'surplus_metrics' => [],
        ];
    }

    protected function user(): UserResource|array
    {
        if (! $this->resource->relationLoaded('user')) {
            return [
                'id' => $this->user_id ?? null,
            ];
        }

        return UserResource::make(
            $this->user
        );
    }

    protected function payPeriod(): PayPeriodResource|array
    {
        if (! $this->resource->relationLoaded('payPeriod')) {
            return [
                'id' => $this->pay_period_id ?? null,
            ];
        }

        return PayPeriodResource::make(
            $this->payPeriod
        );
    }
}
