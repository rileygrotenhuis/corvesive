<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paystub extends Model
{
    use HasFactory;

    protected $table = 'paystubs';

    protected $fillable = [
        'user_id',
        'issuer',
        'amount_in_cents',
        'recurrence_rate',
        'recurrence_interval_one',
        'recurrence_interval_two',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
