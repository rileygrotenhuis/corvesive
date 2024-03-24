<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PayPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paystubs(): BelongsToMany
    {
        return $this->belongsToMany(Paystub::class, 'pay_period_paystub', 'pay_period_id', 'paystub_id')
            ->withPivot('id', 'amount_in_cents');
    }

    public function bills(): BelongsToMany
    {
        return $this->belongsToMany(MonthlyBill::class, 'pay_period_bill', 'pay_period_id', 'bill_id')
            ->withPivot('id', 'amount_in_cents', 'due_date');
    }

    public function budgets(): BelongsToMany
    {
        return $this->belongsToMany(MonthlyBudget::class, 'pay_period_budget', 'pay_period_id', 'budget_id')
            ->withPivot('id', 'total_balance_in_cents');
    }

    public function savings(): BelongsToMany
    {
        return $this->belongsToMany(MonthlySaving::class, 'pay_period_saving', 'pay_period_id', 'saving_id')
            ->withPivot('id', 'amount_in_cents');
    }
}
