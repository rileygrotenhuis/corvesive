<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PayPeriodBill extends Model
{
    use HasFactory;

    protected $table = 'pay_period_bill';

    protected $fillable = [
        'user_id',
        'pay_period_id',
        'bill_id',
        'amount_in_cents',
        'due_date',
    ];

    public function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function bill(): BelongsTo
    {
        return $this->belongsTo(
            MonthlyBill::class,
            'bill_id',
            'id',
        );
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function getAmountPaidAttribute(): int
    {
        return $this->transactions()->sum('amount_in_cents');
    }

    public function getRemainingAmountAttribute(): int
    {
        return $this->amount_in_cents - $this->amount_paid;
    }

    public function getHasPaidAttribute(): bool
    {
        return $this->amount_paid >= $this->amount_in_cents;
    }
}
