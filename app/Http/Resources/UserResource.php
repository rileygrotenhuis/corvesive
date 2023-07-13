<?php

namespace App\Http\Resources;

use App\Models\PayPeriod;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'pay_periods' => $this->whenLoaded('payPeriods', PayPeriod::collection($this->payPeriods))
        ];
    }
}
