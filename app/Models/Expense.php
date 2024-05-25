<?php

namespace App\Models;

use App\Traits\ExpenseManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use ExpenseManager, HasFactory;

    protected $table = 'expenses';

    protected $fillable = [
        'user_id',
        'issuer',
        'name',
        'amount_in_cents',
        'due_day_of_month',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyExpenses(): HasMany
    {
        return $this->hasMany(MonthlyExpense::class);
    }
}
