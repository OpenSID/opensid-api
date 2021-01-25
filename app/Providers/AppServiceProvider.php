<?php

namespace App\Providers;

use App\Supports\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

use function app;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('url', function () {
            return new UrlGenerator(app());
        });

        Request::macro('hasValidSignature', function ($absolute = true) {
            return URL::hasValidSignature($this, $absolute);
        });

        Request::macro('hasValidRelativeSignature', function () {
            return URL::hasValidSignature($this, $absolute = false);
        });
    }
}
