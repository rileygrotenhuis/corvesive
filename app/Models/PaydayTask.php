<?php

namespace App\Models;

use App\Traits\Paystubs\PayDayTaskManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaydayTask extends Model
{
    use HasFactory, PayDayTaskManager;

    protected $table = 'payday_tasks';

    protected $fillable = [
        'user_id',
        'monthly_paystub_id',
        'monthly_expense_id',
        'amount_in_cents',
        'is_completed',
    ];

    protected $appends = ['amount'];

    public function getAmountAttribute(): int
    {
        return $this->amount_in_cents / 100;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyPaystub(): BelongsTo
    {
        return $this->belongsTo(MonthlyPaystub::class);
    }

    public function monthlyExpense(): BelongsTo
    {
        return $this->belongsTo(MonthlyExpense::class);
    }
}
