<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayPeriodSaving extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pay_period_saving';

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function savingAccount(): BelongsTo
    {
        return $this->belongsTo(Saving::class);
    }
}
