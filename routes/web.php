<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // Autentikasi
    $router->group(['prefix' => 'auth', 'namespace' => 'Auth'], function () use ($router) {

        $router->post('login', 'AuthenticatedController@login');

        $router->post('logout', ['middleware' => 'jwt.auth', 'uses' => 'AuthenticatedController@logout']);

        $router->post('forgot-password', ['uses' => 'PasswordResetLinkController@store', 'as' => 'password.email']);

        $router->post('reset-password', ['uses' => 'NewPasswordController@store', 'as' => 'password.update']);

        $router->get('/verify-email/{id}/{hash}', [
            'middleware' => ['jwt.auth', 'signed', 'throttle:6,1'],
            'uses'       => 'VerifyEmailController@__invoke',
            'as'         => 'verification.verify',
        ]);

        $router->get('email/verification-notification', ['middleware' => 'jwt.auth', 'uses' => 'EmailVerificationNotificationController@store', 'as' => 'verification.send']);
    });

    // Layanan mandiri
    $router->group(['prefix' => 'layanan-mandiri', 'middleware' => ['jwt.auth', 'verified']], function () use ($router) {
        //
    });
});
