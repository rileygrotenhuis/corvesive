<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PayPeriodSaving extends Model
{
    use HasFactory;

    protected $table = 'pay_period_saving';

    protected $fillable = [
        'user_id',
        'pay_period_id',
        'saving_id',
        'amount_in_cents',
    ];

    protected $appends = [
        'amount_paid',
        'remaining_amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    //    public function saving(): BelongsTo
    //    {
    //        return $this->belongsTo(MonthlySaving::class);
    //    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function getAmountPaidAttribute(): int
    {
        return $this->transactions->sum('amount_in_cents');
    }

    public function getRemainingAmountAttribute(): int
    {
        return $this->amount_in_cents - $this->amount_paid;
    }
}
