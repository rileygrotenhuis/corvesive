<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Bill;
use App\Models\Budget;
use App\Models\PayPeriod;
use App\Models\Paystub;
use App\Models\Transaction;
use App\Policies\BillPolicy;
use App\Policies\BudgetPolicy;
use App\Policies\PayPeriodPolicy;
use App\Policies\PaystubPolicy;
use App\Policies\TransactionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Bill::class => BillPolicy::class,
        Budget::class => BudgetPolicy::class,
        PayPeriod::class => PayPeriodPolicy::class,
        Paystub::class => PaystubPolicy::class,
        Transaction::class => TransactionPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
