<?php

namespace App\Models;

use App\Traits\Paystubs\PaystubManager;
use App\Traits\Paystubs\PaystubScheduler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paystub extends Model
{
    use HasFactory, PaystubManager, PaystubScheduler;

    protected $table = 'paystubs';

    protected $fillable = [
        'user_id',
        'issuer',
        'amount_in_cents',
        'recurrence_rate',
        'recurrence_interval_one',
        'recurrence_interval_two',
        'notes',
    ];

    protected $appends = [
        'amount',
        'interval_one',
        'interval_two',
    ];

    public function getAmountAttribute(): float
    {
        return $this->amount_in_cents / 100;
    }

    public function getIntervalOneAttribute(): string
    {
        if (is_numeric($this->recurrence_interval_one)) {
            return match ($this->recurrence_interval_one) {
                1 => '1st',
                2 => '2nd',
                3 => '3rd',
                default => $this->recurrence_interval_one.'th',
            };
        }

        return $this->recurrence_interval_one.'\'s';
    }

    public function getIntervalTwoAttribute(): string
    {
        if (is_numeric($this->recurrence_interval_two)) {
            return match ($this->recurrence_interval_two) {
                1 => '1st',
                2 => '2nd',
                3 => '3rd',
                default => $this->recurrence_interval_two.'th',
            };
        }

        return $this->recurrence_interval_two.'\'s';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyPaystubs(): HasMany
    {
        return $this->hasMany(MonthlyPaystub::class);
    }
}
