<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyMetricResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'expenses' => [
                'bills' => CurrencyUtil::formatCurrencyValues($this->bills_total),
                'budgets' => CurrencyUtil::formatCurrencyValues($this->budgets_total),
                'total' => CurrencyUtil::formatCurrencyValues($this->expenses_total),
            ],
            'income' => [
                'paystubs_total' => CurrencyUtil::formatCurrencyValues($this->paystubs_total),
            ],
            'surplus' => [
                'projected' => CurrencyUtil::formatCurrencyValues($this->projected_surplus),
            ],
        ];
    }
}
