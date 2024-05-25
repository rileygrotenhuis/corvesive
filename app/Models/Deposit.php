<?php

namespace App\Models;

use App\Traits\DepositManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use DepositManager, DepositManager, HasFactory;

    protected $table = 'deposits';

    protected $fillable = [
        'user_id',
        'deposit_date',
        'amount_in_cents',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
