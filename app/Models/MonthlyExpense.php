<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyExpense extends Model
{
    use HasFactory;

    protected $table = 'monthly_expense';

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
}
