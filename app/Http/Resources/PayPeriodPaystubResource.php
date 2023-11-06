<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodPaystubResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'amount' => CurrencyUtil::formatCurrencyValues($this->amount),
        ];
    }
}
