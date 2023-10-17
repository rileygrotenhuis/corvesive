<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function payPeriodBill(): BelongsTo
    {
        return $this->belongsTo(PayPeriodBill::class);
    }

    public function payPeriodBudget(): BelongsTo
    {
        return $this->belongsTo(PayPeriodBudget::class);
    }
}
