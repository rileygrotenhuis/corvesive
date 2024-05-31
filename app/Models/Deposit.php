<?php

namespace App\Models;

use App\Traits\Transactions\DepositManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use DepositManager, DepositManager, HasFactory;

    protected $table = 'deposits';

    protected $appends = [
        'amount',
        'deposit_day',
    ];

    protected $fillable = [
        'user_id',
        'monthly_paystub_id',
        'deposit_date',
        'amount_in_cents',
        'notes',
    ];

    public function getAmountAttribute(): float
    {
        return $this->amount_in_cents / 100;
    }

    public function getDepositDayAttribute(): string
    {
        return Carbon::parse($this->deposit_date)->format('m/d');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyPaystub(): BelongsTo
    {
        return $this->belongsTo(MonthlyPaystub::class);
    }
}
