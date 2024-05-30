<?php

namespace App\Models;

use App\Traits\Transactions\PaymentManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, PaymentManager;

    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'monthly_expense_id',
        'payment_date',
        'amount_in_cents',
        'notes',
    ];

    protected $appends = [
        'amount',
        'payment_day',
    ];

    public function getAmountAttribute(): float
    {
        return $this->amount_in_cents / 100;
    }

    public function getPaymentDayAttribute(): string
    {
        return Carbon::parse($this->payment_date)->format('m/d');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyExpense(): BelongsTo
    {
        return $this->belongsTo(MonthlyExpense::class);
    }
}
