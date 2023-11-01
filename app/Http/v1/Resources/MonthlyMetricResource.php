<?php

namespace App\Http\v1\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyMetricResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'expense_metrics' => [
                'bills' => CurrencyUtil::formatCurrencyValues($this->bills_total),
                'budgets' => CurrencyUtil::formatCurrencyValues($this->budgets_total),
                'total' => CurrencyUtil::formatCurrencyValues($this->expenses_total),
            ],
            'income_metrics' => [
                'paystubs_total' => CurrencyUtil::formatCurrencyValues($this->paystubs_total),
            ],
            'surplus_metrics' => [
                'projected' => CurrencyUtil::formatCurrencyValues($this->projected_surplus),
            ],
        ];
    }
}
