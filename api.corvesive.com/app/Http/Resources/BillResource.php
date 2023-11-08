<?php

namespace App\Http\Resources;

use App\Http\Resources\PayPeriods\PayPeriodBillResource;
use App\Http\Resources\PayPeriods\PayPeriodResource;
use App\Util\CurrencyUtil;
use App\Util\DayOfMonthUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'issuer' => $this->issuer,
            'name' => $this->name,
            'amount' => CurrencyUtil::formatCurrencyValues($this->amount),
            'due_date' => [
                'raw' => $this->due_date,
                'pretty' => DayOfMonthUtil::convertDayOfMonthToPrettyString($this->due_date),
            ],
            'notes' => $this->notes,
            'pay_periods' => PayPeriodResource::collection(
                $this->whenLoaded('payPeriods')
            ),
            'pivot' => $this->whenPivotLoaded(
                'pay_period_bill', new PayPeriodBillResource($this->pivot)
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
