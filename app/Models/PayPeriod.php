<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayPeriod extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function budgets(): BelongsToMany
    {
        return $this->belongsToMany(Budget::class);
    }

    public function bills(): BelongsToMany
    {
        return $this->belongsToMany(Bill::class);
    }

    public function savings(): BelongsToMany
    {
        return $this->belongsToMany(Saving::class);
    }
}
