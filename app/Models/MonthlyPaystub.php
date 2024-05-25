<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyPaystub extends Model
{
    use HasFactory;

    protected $table = 'monthly_paystub';

    protected $fillable = [
        'user_id',
        'paystub_id',
        'year',
        'month',
        'pay_day',
        'amount_in_cents',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paystub(): BelongsTo
    {
        return $this->belongsTo(Paystub::class);
    }
}
