<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $policy = new UserPolicy();

        Gate::define('access-superadmin', [$policy, 'superAdminAccess']);
        Gate::define('access-admin', [$policy, 'adminAccess']);
        Gate::define('access-all', [$policy, 'allAccess']);
    }
}
