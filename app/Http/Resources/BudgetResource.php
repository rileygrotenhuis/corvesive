<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BudgetResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user),
            'name' => $this->name,
            'amount' => $this->amount,
            'show_daily_amount' => $this->show_daily_amount,
            'average_daily_amount' => $this->amount / (Carbon::now()->diffInDays(Carbon::parse(Auth::user()->next_payday))),
        ];
    }
}
