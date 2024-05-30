<?php

namespace App\Models;

use App\Traits\Expenses\ExpenseAmounts;
use App\Traits\Expenses\ExpensePayments;
use App\Traits\Expenses\MonthlyExpenseManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyExpense extends Model
{
    use ExpenseAmounts, ExpensePayments, HasFactory, MonthlyExpenseManager;

    protected $table = 'monthly_expenses';

    protected $fillable = [
        'user_id',
        'expense_id',
        'year',
        'month',
        'due_date',
        'amount_in_cents',
    ];

    protected $appends = [
        'due_day',
        'amount',
    ];

    public function getDueDayAttribute(): string
    {
        return Carbon::parse($this->due_date)->format('m/d');
    }

    public function getAmountAttribute(): float
    {
        return $this->amount_in_cents / 100;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function paydayTasks(): HasMany
    {
        return $this->hasMany(PaydayTask::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
