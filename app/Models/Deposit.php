<?php

namespace App\Models;

use App\Traits\Transactions\DepositManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use DepositManager, DepositManager, HasFactory;

    protected $table = 'deposits';

    protected $fillable = [
        'user_id',
        'monthly_paystub_id',
        'deposit_date',
        'amount_in_cents',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyPaystub(): BelongsTo
    {
        return $this->belongsTo(MonthlyPaystub::class);
    }
}
