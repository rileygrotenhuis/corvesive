<?php

namespace App\Http\Resources;

use App\Services\PayPeriodBillService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'issuer' => $this->issuer,
            'name' => $this->name,
            'amount' => [
                'raw' => $this->amount,
                'pretty' => '$'.number_format(($this->amount / 100), 2),
            ],
            'due_date' => $this->due_date,
            'notes' => $this->notes,
            'pay_periods' => PayPeriodResource::collection(
                $this->whenLoaded('payPeriods')
            ),
            'pivot' => $this->whenPivotLoaded('pay_period_bill', function () {
                return [
                    'id' => $this->pivot->id,
                    'amount' => [
                        'raw' => $this->pivot->amount,
                        'pretty' => '$'.number_format(($this->pivot->amount / 100), 2),
                    ],
                    'dates' => [
                        'due' => [
                            'raw' => $this->pivot->due_date,
                            'pretty' => [
                                'full' => Carbon::parse($this->pivot->due_date)->format('F j, Y'),
                                'short' => Carbon::parse($this->pivot->due_date)->format('n/j/y'),
                                'input' => Carbon::parse($this->pivot->due_date)->format('Y-m-d'),
                            ],
                        ],
                    ],
                    'has_payed' => $this->pivot->has_payed,
                    'status' => (new PayPeriodBillService())
                        ->getPayPeriodBillStatus(
                            $this->pivot->has_payed,
                            $this->pivot->due_date
                        ),
                ];
            }),
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
}
