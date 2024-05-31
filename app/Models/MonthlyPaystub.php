<?php

namespace App\Models;

use App\Traits\Paystubs\MonthlyPaystubManager;
use App\Traits\Paystubs\PaystubAmounts;
use App\Traits\Paystubs\PaystubDeposits;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyPaystub extends Model
{
    use HasFactory, MonthlyPaystubManager, PaystubAmounts, PaystubDeposits;

    protected $table = 'monthly_paystubs';

    protected $fillable = [
        'user_id',
        'paystub_id',
        'year',
        'month',
        'pay_day',
        'amount_in_cents',
    ];

    protected $appends = [
        'pay_date',
        'amount',
    ];

    public function getPayDateAttribute(): string
    {
        return Carbon::parse($this->pay_day)->format('m/d');
    }

    public function getAmountAttribute(): float
    {
        return $this->amount_in_cents / 100;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paystub(): BelongsTo
    {
        return $this->belongsTo(Paystub::class);
    }

    public function paydayTasks(): HasMany
    {
        return $this->hasMany(PaydayTask::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }
}
