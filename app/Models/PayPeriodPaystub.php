<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayPeriodPaystub extends Model
{
    use HasFactory;

    protected $table = 'pay_period_paystub';

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function paystub(): BelongsTo
    {
        return $this->belongsTo(Paystub::class);
    }
}
