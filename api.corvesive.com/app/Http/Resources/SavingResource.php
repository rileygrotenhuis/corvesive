<?php

namespace App\Http\Resources;

use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Http\Resources\PayPeriods\PayPeriodSavingResource;
use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class SavingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'name' => $this->name,
            'amount' => CurrencyUtil::formatCurrencyValues($this->amount),
            'notes' => $this->notes,
            'pay_periods' => PayPeriodResource::collection(
                $this->whenLoaded('payPeriods')
            ),
            //            'pivot' => $this->whenPivotLoaded(
            //                'pay_period_saving', new PayPeriodSavingResource($this->pivot)
            //            ),
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
