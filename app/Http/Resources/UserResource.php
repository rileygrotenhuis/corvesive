<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'names' => [
                'first' => $this->first_name,
                'last' => $this->last_name,
                'full' => $this->first_name.' '.$this->last_name,
            ],
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'pay_period' => $this->payPeriod(),
            'paystubs' => PaystubResource::collection(
                $this->whenLoaded('paystubs')
            ),
        ];
    }

    protected function payPeriod(): PayPeriodResource|array
    {
        return PayPeriodResource::make(
            $this->payPeriod->load([
                'paystubs',
                'bills' => function ($query) {
                    $query->orderBy('pay_period_bill.has_payed', 'asc')
                        ->orderBy('pay_period_bill.due_date', 'asc');
                },
                'budgets' => function ($query) {
                    $query->orderBy('pay_period_budget.remaining_balance', 'desc');
                },
            ])
        );
    }
}
