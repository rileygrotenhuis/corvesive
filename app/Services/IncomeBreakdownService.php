<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class IncomeBreakdownService
{
    protected Collection $incomeBreakdown;

    public function __construct(protected User $user)
    {
        $this->incomeBreakdown = $this->incomeBreakdown();
    }

    public function getChartLabels(): array
    {
        return $this->incomeBreakdown->keys()->toArray();
    }

    public function getChartData(): array
    {
        return [
            [
                'label' => 'Monthly Income Breakdown',
                'data' => $this->incomeBreakdown->values()->map(function ($paystub) {
                    return $paystub->sum('amount_in_cents') / 100;
                }),
            ],
        ];
    }

    public function getCardData(): array
    {
        $card = $this->incomeBreakdown->map(function ($paystub, $issuer) {
            return [
                'issuer' => $issuer,
                'total' => '$'.number_format($paystub->sum('amount_in_cents') / 100, 2),
            ];
        })->toArray();

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

    protected function incomeBreakdown(): Collection
    {
        return $this->user->paystubs()->get()->groupBy('issuer');
    }
}
