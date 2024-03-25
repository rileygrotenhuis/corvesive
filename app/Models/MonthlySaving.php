<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MonthlySaving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'amount_in_cents',
        'notes',
    ];

    protected $appends = [
        'amount_paid',
        'amount_remaining',
        'has_paid',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriods(): BelongsToMany
    {
        return $this->belongsToMany(
            PayPeriod::class,
            'pay_period_saving',
            'saving_id',
            'pay_period_id',
        );
    }

    public function getAmountPaidAttribute(): int
    {
        $currentPayPeriodIds = PayPeriod::currentMonthForUser($this->user)->pluck('id');
        $payPeriodSavingIds = PayPeriodSaving::query()
            ->whereIn('pay_period_id', $currentPayPeriodIds)
            ->where('saving_id', $this->id)
            ->pluck('id');

        return Transaction::query()
            ->where('transactionable_type', PayPeriodSaving::class)
            ->whereIn('transactionable_id', $payPeriodSavingIds)
            ->sum('amount_in_cents');
    }

    public function getAmountRemainingAttribute(): int
    {
        return $this->amount_in_cents - $this->amount_paid;
    }

    public function getHasPaidAttribute(): bool
    {
        return $this->amount_paid >= $this->amount_in_cents;
    }
}
