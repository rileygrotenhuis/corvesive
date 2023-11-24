<?php

namespace App\Http\Resources;

use App\Http\Resources\PayPeriods\PayPeriodResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'names' => [
                'first' => $this->first_name,
                'last' => $this->last_name,
                'full' => $this->first_name.' '.$this->last_name,
            ],
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'pay_period' => $this->payPeriod(),
            'paystubs' => PaystubResource::collection(
                $this->whenLoaded('paystubs')
            ),
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
}
