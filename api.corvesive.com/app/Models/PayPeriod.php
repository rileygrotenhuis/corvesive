<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayPeriod extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pay_periods';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paystubs(): BelongsToMany
    {
        return $this->belongsToMany(Paystub::class, 'pay_period_paystub')
            ->withPivot('id', 'amount');
    }

    public function bills(): BelongsToMany
    {
        return $this
            ->belongsToMany(Bill::class, 'pay_period_bill')
            ->withPivot('id', 'amount', 'due_date', 'has_payed');
    }

    public function budgets(): BelongsToMany
    {
        return $this
            ->belongsToMany(Budget::class, 'pay_period_budget')
            ->withPivot('id', 'total_balance', 'remaining_balance');
    }

    public function savingAccounts(): BelongsToMany
    {
        return $this
            ->belongsToMany(Saving::class, 'pay_period_saving')
            ->withPivot('id', 'amount');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function numberOfDays(): int
    {
        return Carbon::parse($this->start_date)
            ->diffInDays(
                Carbon::parse($this->end_date)
            );
    }

    public function monthCoveragePercentage(): float
    {
        return $this->numberOfDays() / Carbon::now()->daysInMonth;
    }
}
