<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class RecurringMetricsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'income' => [
                'paystubs' => CurrencyUtil::formatCurrencyValues($this->paystubs_total),
            ],
            'expenses' => [
                'bills' => CurrencyUtil::formatCurrencyValues($this->bills_total),
                'budgets' => CurrencyUtil::formatCurrencyValues($this->budgets_total),
                'savings' => CurrencyUtil::formatCurrencyValues($this->savings_total),
                'total' => CurrencyUtil::formatCurrencyValues($this->expenses_total),
            ],
            'surplus' => [
                'projected' => CurrencyUtil::formatCurrencyValues($this->projected_surplus),
            ],
        ];
    }
}
