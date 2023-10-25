<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodMetricResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user_id' => $this->user_id,
            'pay_period_id' => $this->pay_period_id,
            'bill_metrics' => [
                'total_payed' => CurrencyUtil::formatCurrencyValues($this->bills_total_payed),
                'total_unpayed' => CurrencyUtil::formatCurrencyValues($this->bills_total_unpayed),
                'total' => CurrencyUtil::formatCurrencyValues($this->bills_total),
            ],
            'budget_metrics' => [
                'total_balance' => CurrencyUtil::formatCurrencyValues($this->budgets_total_balance),
                'remaining_balance' => CurrencyUtil::formatCurrencyValues($this->budgets_remaining_balance),
            ],
            'income_metrics' => [
                'total_paystubs' => CurrencyUtil::formatCurrencyValues($this->total_paystubs),
                'total_income' => CurrencyUtil::formatCurrencyValues($this->total_income),
            ],
            'transaction_metrics' => [
                'total_spent' => [
                    'bills' => CurrencyUtil::formatCurrencyValues($this->bills_total_spent),
                    'budgets' => CurrencyUtil::formatCurrencyValues($this->budgets_total_spent),
                    'total' => CurrencyUtil::formatCurrencyValues($this->total_spent),
                ],
                'total_deposited' => CurrencyUtil::formatCurrencyValues($this->total_deposited),
            ],
            'surplus_metrics' => [
                'current' => CurrencyUtil::formatCurrencyValues($this->current_surplus),
                'projected' => CurrencyUtil::formatCurrencyValues($this->projected_surplus),
            ],
        ];
    }
}
