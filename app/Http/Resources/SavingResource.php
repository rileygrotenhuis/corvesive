<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SavingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'pay_period_id' => $this->pay_period_id,
            'name' => $this->name,
            'amount' => $this->amount,
            'has_payed' => $this->has_payed,
        ];
    }
}
