<?php

namespace App\Http\Resources;

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
            'amount' => [
                'raw' => $this->amount,
                'pretty' => '$'.number_format(($this->amount / 100), 2),
            ],
            'notes' => $this->notes,
            'pay_periods' => PayPeriodResource::collection(
                $this->whenLoaded('payPeriods')
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
