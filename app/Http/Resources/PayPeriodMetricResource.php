<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodMetricResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user_id' => $this->userId,
            'pay_period_id' => $this->payPeriodId,
            'bill_metrics' => [
                'total_payed' => CurrencyUtil::formatCurrencyValues($this->billsTotalPayed),
                'total_unpayed' => CurrencyUtil::formatCurrencyValues($this->billsTotalUnpayed),
                'total' => CurrencyUtil::formatCurrencyValues($this->billsTotal),
            ],
            'budget_metrics' => [
                'total_balance' => CurrencyUtil::formatCurrencyValues($this->budgetsTotalBalance),
                'remaining_balance' => CurrencyUtil::formatCurrencyValues($this->budgetsRemainingBalance),
            ],
            'income_metrics' => [
                'total_paystubs' => CurrencyUtil::formatCurrencyValues($this->totalPaystubs),
                'total_income' => CurrencyUtil::formatCurrencyValues($this->totalIncome),
            ],
            'transaction_metrics' => [
                'total_spent' => [
                    'bills' => CurrencyUtil::formatCurrencyValues($this->billsTotalSpent),
                    'budgets' => CurrencyUtil::formatCurrencyValues($this->budgetsTotalSpent),
                    'total' => CurrencyUtil::formatCurrencyValues($this->totalSpent),
                ],
                'total_deposited' => CurrencyUtil::formatCurrencyValues($this->totalDeposited),
            ],
            'surplus_metrics' => [
                'current' => CurrencyUtil::formatCurrencyValues($this->currentSurplus),
                'projected' => CurrencyUtil::formatCurrencyValues($this->projectedSurplus),
            ],
        ];
    }
}
