<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $appends = [
        'full_name',
        'initials',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getInitialsAttribute(): string
    {
        return $this->first_name[0].$this->last_name[0];
    }

    public function paystubs(): HasMany
    {
        return $this->hasMany(Paystub::class);
    }

    public function monthlyPaystubs(): HasMany
    {
        return $this->hasMany(MonthlyPaystub::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function monthlyExpenses(): HasMany
    {
        return $this->hasMany(MonthlyExpense::class);
    }

    public function paydayTasks(): HasMany
    {
        return $this->hasMany(PaydayTask::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }
}
