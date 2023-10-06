<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditAccountResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'issuer' => $this->issuer,
            'name' => $this->name,
            'type' => $this->type,
            'credit_limit' => [
                'raw' => $this->credit_limit,
                'pretty' => '$'.number_format(($this->credit_limit / 100), 2),
            ],
            'interest_rate' => $this->interest_rate,
            'annual_fee' => [
                'raw' => $this->annual_fee,
                'pretty' => '$'.number_format(($this->annual_fee / 100), 2),
            ],
            'benefits' => $this->benefits,
            'notes' => $this->notes,
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
