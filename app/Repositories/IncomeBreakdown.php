<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class IncomeBreakdown
{
    public function __construct(protected User $user)
    {
    }

    public function getIncomeBreakdown(): array
    {
        return [
            'card' => $this->getPaystubsBreakdown(),
        ];
    }

    protected function getPaystubsBreakdown(): Collection
    {
        $card = $this->user->paystubs()->get()->groupBy('issuer')->map(function ($paystubs) {
            return [
                'issuer' => $paystubs[0]['issuer'],
                'total' => '$'.number_format(
                    $paystubs->sum('amount_in_cents') / 100,
                    2
                ),
            ];
        });

        $card['total'] = $this->getIncomeTotal();

        return $card;
    }

    protected function getIncomeTotal(): string
    {
        return '$'.number_format(
            $this->user->paystubs()->sum('amount_in_cents') / 100,
            2
        );
    }
}
