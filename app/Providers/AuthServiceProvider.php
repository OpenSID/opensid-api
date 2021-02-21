<?php

namespace App\Providers;

use App\Supports\CustomUserProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Adding custom provider
        $this->app['auth']->provider('custom', function ($app, array $config) {
            return new CustomUserProvider($app['hash'], $config['model'], $config['belongsTo']);
        });
    }
}
