<?php

namespace App\Http\Resources\PayPeriods;

use App\Http\Resources\TransactionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodAttributesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'bills' => [
                'payed' => PayPeriodBillResource::collection($this->payed_bills),
                'upcoming' => PayPeriodBillResource::collection($this->upcoming_bills),
                'overdue' => PayPeriodBillResource::collection($this->overdue_bills),
            ],
            'budgets' => [
                'remaining' => PayPeriodBudgetResource::collection($this->remaining_budgets),
                'overpayed' => PayPeriodBudgetResource::collection($this->overpayed_budgets),
                'payed' => PayPeriodBudgetResource::collection($this->payed_budgets),
            ],
            'transactions' => [
                'recent' => TransactionResource::collection($this->recent_transactions),
            ],
        ];
    }
}
