<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('control-insurance', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('get-all-insurances', function ($user) {
            return $user->isManager();
        });

        Gate::define('get-not-approved-insurances', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('order-another-insurance', function ($user) {
            return !$user->hasOrderedPlan();
        });
    }
}
