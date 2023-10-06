<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpendingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'pay_period' => $this->payPeriod(),
            'total_balance' => [
                'raw' => $this->total_balance,
                'pretty' => '$'.number_format(($this->total_balance / 100), 2),
            ],
            'remaining_balance' => [
                'raw' => $this->remaining_balance,
                'pretty' => '$'.number_format(($this->remaining_balance / 100), 2),
            ],
        ];
    }

    protected function user(): UserResource|array
    {
        if (! $this->resource->relationLoaded('user')) {
            return [
                'id' => $this->user_id,
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
                'id' => $this->pay_period_id,
            ];
        }

        return PayPeriodResource::make(
            $this->payPeriod
        );
    }
}
