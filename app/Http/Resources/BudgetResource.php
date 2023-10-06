<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'name' => $this->name,
            'amount' => [
                'raw' => $this->amount,
                'pretty' => '$'.number_format(($this->amount / 100), 2),
            ],
            'notes' => $this->notes,
            'pay_periods' => PayPeriodResource::collection(
                $this->whenLoaded('payPeriods')
            ),
            'pivot' => $this->whenPivotLoaded('pay_period_budget', function () {
                return [
                    'id' => $this->pivot->id,
                    'total_balance' => [
                        'raw' => $this->pivot->total_balance,
                        'pretty' => '$'.number_format(($this->pivot->total_balance / 100), 2),
                    ],
                    'remaining_balance' => [
                        'raw' => $this->pivot->remaining_balance,
                        'pretty' => '$'.number_format(($this->pivot->remaining_balance / 100), 2),
                    ],
                ];
            }),
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
