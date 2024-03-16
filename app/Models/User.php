<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function paystubs(): HasMany
    {
        return $this->hasMany(Paystub::class);
    }

    public function monthlyBills(): HasMany
    {
        return $this->hasMany(MonthlyBill::class);
    }

    public function monthlyBudgets(): HasMany
    {
        return $this->hasMany(MonthlyBudget::class);
    }

    public function monthlySavings(): HasMany
    {
        return $this->hasMany(MonthlySaving::class);
    }

    public function payPeriods(): HasMany
    {
        return $this->hasMany(PayPeriod::class);
    }

    public function payPeriodPaystubs(): HasMany
    {
        return $this->hasMany(PayPeriodPaystub::class);
    }

    public function payPeriodBills(): HasMany
    {
        return $this->hasMany(PayPeriodBill::class);
    }

    public function payPeriodBudgets(): HasMany
    {
        return $this->hasMany(PayPeriodBudget::class);
    }

    public function payPeriodSavings(): HasMany
    {
        return $this->hasMany(PayPeriodSaving::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }
}
