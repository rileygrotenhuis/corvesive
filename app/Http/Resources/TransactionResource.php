<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'transactionable_type' => $this->transactionable_type,
            'transactionable_id' => $this->transactionable_id,
            'amount' => [
                'raw' => $this->amount,
                'pretty' => '$'.number_format(($this->amount / 100), 2),
            ],
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
