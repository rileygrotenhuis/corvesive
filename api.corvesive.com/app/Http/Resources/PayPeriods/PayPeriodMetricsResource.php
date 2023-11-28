<?php

namespace App\Http\Resources\PayPeriods;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodMetricsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'income' => [
                'paystubs' => CurrencyUtil::formatCurrencyValues($this->paystubs_total),
                'deposits' => CurrencyUtil::formatCurrencyValues($this->deposits_total),
                'total' => CurrencyUtil::formatCurrencyValues($this->income_total),
            ],
            'expenses' => [
                'bills' => [
                    'payed' => CurrencyUtil::formatCurrencyValues($this->payed_bills_total),
                    'unpayed' => CurrencyUtil::formatCurrencyValues($this->unpayed_bills_total),
                    'total' => CurrencyUtil::formatCurrencyValues($this->bills_total),
                ],
                'budgets' => [
                    'total_balance' => CurrencyUtil::formatCurrencyValues($this->budgets_balance_total),
                    'remaining_balance' => CurrencyUtil::formatCurrencyValues($this->remaining_budgets_total),
                    'spent' => CurrencyUtil::formatCurrencyValues($this->budgets_spent_total),
                ],
                'savings' => [
                    'total' => CurrencyUtil::formatCurrencyValues($this->savings_total),
                ],
                'spent' => CurrencyUtil::formatCurrencyValues($this->spent_total),
                'remaining' => CurrencyUtil::formatCurrencyValues($this->remaining_total),
                'total' => CurrencyUtil::formatCurrencyValues($this->expenses_total),
            ],
            'surplus' => [
                'projected' => CurrencyUtil::formatCurrencyValues($this->projected_surplus),
                'current' => CurrencyUtil::formatCurrencyValues($this->current_surplus),
            ],
        ];
    }
}
