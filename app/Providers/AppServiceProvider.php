<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /**
         * Defines the authorization for who is allowed
         * to view the Pulse dashboard.
         */
        Gate::define('viewPulse', function (User $user) {
            if (app()->environment('local')) {
                return true;
            }

            return in_array($user->email, [
                'rileygrotenhuis@gmail.com',
            ]);
        });
    }
}
