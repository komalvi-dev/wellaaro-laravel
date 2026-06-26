<?php

namespace App\Providers;

use App\Hashing\RailsCompatibleHasher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('hash', fn($app) => new RailsCompatibleHasher($app['config']['hashing'] ?? []));
        $this->app->singleton('hash.driver', fn($app) => $app['hash']->driver());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        \Illuminate\Pagination\Paginator::useBootstrapFive();
    }
}
