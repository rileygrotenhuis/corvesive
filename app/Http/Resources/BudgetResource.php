<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'name' => $this->name,
            'amount' => $this->amount,
            'remaining_balance' => $this->remaining_balance,
        ];
    }
}
