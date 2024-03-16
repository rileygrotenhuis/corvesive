<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PayPeriodBudget extends Model
{
    use HasFactory;

    protected $table = 'pay_period_budget';

    protected $fillable = [
        'user_id',
        'pay_period_id',
        'budget_id',
        'total_balance_in_cents',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(
            MonthlyBudget::class,
            'budget_id',
            'id',
        );
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function getAmountPaidAttribute(): int
    {
        return $this->transactions->sum('amount_in_cents');
    }

    public function getRemainingBalanceAttribute(): int
    {
        return $this->total_balance_in_cents - $this->amount_paid;
    }
}
