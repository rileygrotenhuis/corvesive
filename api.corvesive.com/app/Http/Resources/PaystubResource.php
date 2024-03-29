<?php

namespace App\Http\Resources;

use App\Http\Resources\PayPeriods\PayPeriodPaystubResource;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PaystubResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'issuer' => $this->issuer,
            'type' => $this->type,
            'amount' => CurrencyUtil::formatCurrencyValues($this->amount),
            'notes' => $this->notes,
            'pay_periods' => PayPeriodResource::collection(
                $this->whenLoaded('payPeriods')
            ),
            'pivot' => $this->whenPivotLoaded(
                'pay_period_paystub', new PayPeriodPaystubResource($this->pivot)
            ),
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
}
