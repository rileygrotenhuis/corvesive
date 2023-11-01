<?php

namespace App\Http\v1\Resources;

use App\Util\CurrencyUtil;
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
            'credit_limit' => CurrencyUtil::formatCurrencyValues($this->credit_limit),
            'interest_rate' => $this->interest_rate,
            'annual_fee' => CurrencyUtil::formatCurrencyValues($this->annual_fee),
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
