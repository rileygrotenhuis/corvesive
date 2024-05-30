<?php

namespace App\Models;

use App\Traits\Expenses\ExpenseManager;
use App\Traits\Expenses\ExpenseScheduler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use ExpenseManager, ExpenseScheduler, HasFactory;

    protected $table = 'expenses';

    protected $fillable = [
        'user_id',
        'type',
        'issuer',
        'name',
        'amount_in_cents',
        'due_day_of_month',
        'notes',
    ];

    protected $appends = [
        'amount',
        'due_day',
    ];

    public function getTypeAttribute(): string
    {
        return ucfirst($this->attributes['type']);
    }

    public function getAmountAttribute(): float
    {
        return $this->amount_in_cents / 100;
    }

    public function getDueDayAttribute(): string
    {
        return $this->due_day_of_month.match ($this->due_day_of_month) {
            1 => 'st',
            2 => 'nd',
            3 => 'rd',
            default => 'th',
        };
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyExpenses(): HasMany
    {
        return $this->hasMany(MonthlyExpense::class);
    }
}
