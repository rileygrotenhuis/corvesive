<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MonthlyBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'total_balance_in_cents',
        'notes',
    ];

    protected $appends = [
        'amount_paid',
        'remaining_balance',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriods(): BelongsToMany
    {
        return $this->belongsToMany(
            PayPeriod::class,
            'pay_period_budget',
            'budget_id',
            'pay_period_id',
        );
    }

    public function getAmountPaidAttribute(): int
    {
        $currentPayPeriodIds = PayPeriod::currentMonthForUser($this->user)->pluck('id');
        $payPeriodBudgetIds = PayPeriodBudget::query()
            ->whereIn('pay_period_id', $currentPayPeriodIds)
            ->where('budget_id', $this->id)
            ->pluck('id');

        return Transaction::query()
            ->where('transactionable_type', PayPeriodBudget::class)
            ->whereIn('transactionable_id', $payPeriodBudgetIds)
            ->sum('amount_in_cents');
    }

    public function getRemainingBalanceAttribute(): int
    {
        return $this->total_balance_in_cents - $this->amount_paid;
    }
}
