<?php

namespace App\Http\v1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodDashboardResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'upcoming_bills' => PayPeriodBillResource::collection($this->upcoming_bills),
            'remaining_budgets' => PayPeriodBudgetResource::collection($this->remaining_budgets),
        ];
    }
}
