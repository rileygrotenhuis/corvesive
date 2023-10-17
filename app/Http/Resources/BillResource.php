<?php

namespace App\Http\Resources;

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
            'amount' => [
                'raw' => $this->amount,
                'pretty' => '$'.number_format(($this->amount / 100), 2),
            ],
            'due_date' => $this->due_date,
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
