<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Enums\Roles;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-dashboard', fn () => auth()->user()->hasRole(Roles::ADMINSTRATOR));
        Gate::define('agent_permission', fn () => auth()->user()->hasRole(Roles::AGENT));

    }
}
