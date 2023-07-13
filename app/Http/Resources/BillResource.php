<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
            'pay_period' => $this->whenLoaded('payPeriod', new PayPeriodResource($this->payPeriod)),
            'name' => $this->name,
            'amount' => $this->amount,
            'has_payed' => $this->has_payed,
        ];
    }
}
