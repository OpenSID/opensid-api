<?php

namespace App\Providers;

use App\Supports\Md5Hashing;
use App\Supports\UrlGenerator;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Contracts\Mail\Factory;
use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\MailManager;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MailServiceProvider::class);
        $this->app->register(NotificationServiceProvider::class);
        $this->app->register(PasswordResetServiceProvider::class);

        $this->app->alias('mailer', Mailer::class);
        $this->app->alias('mailer', MailerContract::class);
        $this->app->alias('mailer', MailQueue::class);
        $this->app->alias('mail.manager', MailManager::class);
        $this->app->alias('mail.manager', Factory::class);

        $this->app['hash']->extend('md5', function () {
            return new Md5Hashing();
        });

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
