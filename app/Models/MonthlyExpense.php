<?php

namespace App\Models;

use App\Traits\Expenses\MonthlyExpenseManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyExpense extends Model
{
    use HasFactory, MonthlyExpenseManager;

    protected $table = 'monthly_expenses';

    protected $fillable = [
        'user_id',
        'expense_id',
        'year',
        'month',
        'due_date',
        'amount_in_cents',
    ];

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
