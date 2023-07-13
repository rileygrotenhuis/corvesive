<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_balance' => $this->total_balance,
            'expenses' => [
                'budgets' => $this->whenLoaded('budgets', BudgetResource::collection($this->budgets)),
                'bills' => $this->whenLoaded('bills', BillResource::collection($this->bills)),
                'savings' => $this->whenLoaded('savings', SavingResource::collection($this->savings)),
            ],
        ];
    }
}
