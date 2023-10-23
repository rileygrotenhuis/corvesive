<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'pay_period' => $this->payPeriod(),
            'pay_period_bill' => $this->payPeriodBill(),
            'pay_period_budget' => $this->payPeriodBudget(),
            'type' => ucfirst($this->type),
            'amount' => CurrencyUtil::formatCurrencyValues(abs($this->amount)),
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

    protected function payPeriod(): PayPeriodResource|array
    {
        if (! $this->resource->relationLoaded('payPeriod')) {
            return [
                'id' => $this->pay_period_id,
            ];
        }

        return PayPeriodResource::make(
            $this->payPeriod
        );
    }

    protected function payPeriodBill(): PayPeriodBillResource|array
    {
        if (! $this->resource->relationLoaded('payPeriodBill')) {
            return [
                'id' => $this->pay_period_bill_id,
            ];
        }

        return PayPeriodBillResource::make(
            $this->payPeriodBill
        );
    }

    protected function payPeriodBudget(): PayPeriodBudgetResource|array
    {
        if (! $this->resource->relationLoaded('payPeriodBudget')) {
            return [
                'id' => $this->pay_period_budget_id,
            ];
        }

        return PayPeriodBudgetResource::make(
            $this->payPeriodBudget
        );
    }
}
