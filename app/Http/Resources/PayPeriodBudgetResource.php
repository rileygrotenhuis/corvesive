<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodBudgetResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'total_balance' => CurrencyUtil::formatCurrencyValues($this->total_balance),
            'remaining_balance' => CurrencyUtil::formatCurrencyValues($this->remaining_balance),
        ];
    }
}
