<?php

namespace App\Models;

use App\Traits\Paystubs\PaystubManager;
use App\Traits\Paystubs\PaystubScheduler;
use Carbon\Carbon;
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
        'recurrence',
        'interval_one',
        'interval_two',
    ];

    public function getAmountAttribute(): float
    {
        return $this->amount_in_cents / 100;
    }

    public function getRecurrenceAttribute(): string
    {
        $rate = ucfirst($this->recurrence_rate);

        $final = $rate.', every '.$this->interval_one;

        if ($this->recurrence_interval_two) {
            $final .= ' and '.$this->interval_two;
        }

        return $final;
    }

    public function getIntervalOneAttribute(): string
    {
        if ($this->recurrence_rate === 'monthly' || $this->recurrence_rate === 'semi-monthly') {
            return match ($this->recurrence_interval_one) {
                1 => '1st',
                2 => '2nd',
                3 => '3rd',
                default => $this->recurrence_interval_one.'th',
            };
        }

        return Carbon::now()->startOfWeek()->addDays((int) $this->recurrence_interval_one)->format('l');
    }

    public function getIntervalTwoAttribute(): ?string
    {
        if (is_null($this->recurrence_interval_two)) {
            return null;
        }

        if ($this->recurrence_rate === 'monthly' || $this->recurrence_rate === 'semi-monthly') {
            return match ($this->recurrence_interval_two) {
                1 => '1st',
                2 => '2nd',
                3 => '3rd',
                default => $this->recurrence_interval_two.'th',
            };
        }

        return Carbon::now()->startOfWeek()->addDays((int) $this->recurrence_interval_two)->format('jS');
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
