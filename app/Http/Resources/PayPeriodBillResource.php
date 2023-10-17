<?php

namespace App\Http\Resources;

use App\Services\PayPeriodBillService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodBillResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'amount' => [
                'raw' => $this->amount,
                'pretty' => '$'.number_format(($this->amount / 100), 2),
            ],
            'dates' => [
                'due' => [
                    'raw' => $this->due_date,
                    'pretty' => [
                        'full' => Carbon::parse($this->due_date)->format('F j, Y'),
                        'short' => Carbon::parse($this->due_date)->format('n/j/y'),
                        'input' => Carbon::parse($this->due_date)->format('Y-m-d'),
                    ],
                ],
            ],
            'has_payed' => $this->has_payed,
            'status' => (new PayPeriodBillService())
                ->getPayPeriodBillStatus(
                    $this->has_payed,
                    $this->due_date
                ),
        ];
    }
}
