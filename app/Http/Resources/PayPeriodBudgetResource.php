<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodBudgetResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'total_balance' => [
                'raw' => $this->total_balance,
                'pretty' => '$'.number_format(($this->total_balance / 100), 2),
            ],
            'remaining_balance' => [
                'raw' => $this->remaining_balance,
                'pretty' => '$'.number_format(($this->remaining_balance / 100), 2),
            ],
        ];
    }
}
