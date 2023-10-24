<?php

namespace App\Http\Resources;

use App\Util\CurrencyUtil;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PayPeriodResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'dates' => [
                'start' => [
                    'raw' => $this->start_date,
                    'pretty' => [
                        'full' => Carbon::parse($this->start_date)->format('F j, Y'),
                        'short' => Carbon::parse($this->start_date)->format('n/j/y'),
                        'input' => Carbon::parse($this->start_date)->format('Y-m-d'),
                    ],
                ],
                'end' => [
                    'raw' => $this->end_date,
                    'pretty' => [
                        'full' => Carbon::parse($this->end_date)->format('F j, Y'),
                        'short' => Carbon::parse($this->end_date)->format('n/j/y'),
                        'input' => Carbon::parse($this->end_date)->format('Y-m-d'),
                    ],
                ],
            ],
            'total_balance' => CurrencyUtil::formatCurrencyValues($this->total_balance),
            'is_complete' => $this->is_complete,
            'paystubs' => PaystubResource::collection(
                $this->whenLoaded('paystubs')
            ),
            'bills' => BillResource::collection(
                $this->whenLoaded('bills')
            ),
            'budgets' => BudgetResource::collection(
                $this->whenLoaded('budgets')
            ),
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
