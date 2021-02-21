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
        $this->app->register(\Illuminate\Mail\MailServiceProvider::class);
        $this->app->register(\Illuminate\Notifications\NotificationServiceProvider::class);
        $this->app->register(\Illuminate\Auth\Passwords\PasswordResetServiceProvider::class);

        $this->app->alias('mailer', \Illuminate\Mail\Mailer::class);
        $this->app->alias('mailer', \Illuminate\Contracts\Mail\Mailer::class);
        $this->app->alias('mailer', \Illuminate\Contracts\Mail\MailQueue::class);
        $this->app->alias('mail.manager', \Illuminate\Mail\MailManager::class);
        $this->app->alias('mail.manager', \Illuminate\Contracts\Mail\Factory::class);

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
