<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        // Prevent lazy loading in development (catches N+1 issues)
        Model::preventLazyLoading(!app()->isProduction());

        // Prevent silently discarding attributes in development
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        // Enable query logging only in local environment for debugging
        if (app()->isLocal() && config('app.debug')) {
            DB::enableQueryLog();
        }
    }
}
