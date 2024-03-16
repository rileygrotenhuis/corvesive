<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayPeriodPaystub extends Model
{
    use HasFactory;

    protected $table = 'pay_period_paystub';

    protected $fillable = [
        'user_id',
        'pay_period_id',
        'paystub_id',
        'amount_in_cents',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function paystub(): BelongsTo
    {
        return $this->belongsTo(Paystub::class);
    }
}
