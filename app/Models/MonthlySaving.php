<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MonthlySaving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'amount_in_cents',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payPeriods(): BelongsToMany
    {
        return $this->belongsToMany(
            PayPeriod::class,
            'pay_period_saving',
            'saving_id',
            'pay_period_id',
        );
    }
}
