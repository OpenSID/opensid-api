<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return response()->json($router->app->version());
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // Autentikasi
    $router->group(['prefix' => 'auth', 'namespace' => 'Auth'], function () use ($router) {
        $router->post('login', 'AuthenticatedController@login');
        $router->post('logout', ['middleware' => 'jwt.auth', 'uses' => 'AuthenticatedController@logout']);
        $router->post('forgot-password', ['uses' => 'PasswordResetLinkController@store', 'as' => 'password.email']);
        $router->post('reset-password', ['uses' => 'NewPasswordController@store', 'as' => 'password.update']);
        $router->get('verify-email/{id}/{hash}', [
            'middleware' => ['jwt.auth', 'signed', 'throttle:6,1'],
            'uses'       => 'VerifyEmailController@__invoke',
            'as'         => 'verification.verify',
        ]);
        $router->post('email/verification-notification', [
            'middleware' => ['jwt.auth', 'throttle:6,1'],
            'uses'       => 'EmailVerificationNotificationController@store',
            'as'         => 'verification.send'
        ]);
    });

    // Artikel
    $router->group(['prefix' => 'artikel'], function () use ($router) {
        $router->get('/', 'ArticleController@index');
        $router->get('read/{slug}', 'ArticleController@show');
        $router->get('headline', 'ArticleController@headline');
        $router->get('kategori', 'CategoryController@index');
        $router->get('kategori/{slug}', 'CategoryController@show');
        $router->get('komentar', 'CommentController@index');
        $router->get('komentar/{id}', 'CommentController@show');
    });

    // Layanan mandiri
    $router->group(['prefix' => 'layanan-mandiri', 'middleware' => ['jwt.auth', 'verified']], function () use ($router) {
        // Mandiri pesan masuk
        $router->group(['prefix' => 'pesan'], function () use ($router) {
            $router->get('tipe/{tipe}', 'PesanController@index');
            $router->get('detail/{id}', 'PesanController@show');
            $router->post('/', 'PesanController@store');
        });

        // Mandiri program bantuan
        $router->get('bantuan', 'Bantuancontroller@index');
        $router->get('bantuan/{id}', 'BantuanController@show');

        // Mandiri surat
        $router->group(['prefix' => 'surat'], function () use ($router) {
            $router->get('arsip', 'SuratController@arsip');
            $router->get('permohonan', 'SuratController@permohonan');
        });
    });
});
