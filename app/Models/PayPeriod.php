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
        return $this->belongsToMany(Paystub::class);
    }

    public function bills(): BelongsToMany
    {
        return $this->belongsToMany(MonthlyBill::class);
    }

    public function budgets(): BelongsToMany
    {
        return $this->belongsToMany(MonthlyBudget::class);
    }

    public function savings(): BelongsToMany
    {
        return $this->belongsToMany(MonthlySaving::class);
    }
}
