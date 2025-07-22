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

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // Auth route (tanpa middleware)
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    // Komik list bisa diakses siapa saja
    $router->get('komik', 'KomikController@index');

    // Sewa list bisa diakses siapa saja
    $router->get('sewa', 'SewaController@index');

    // 👮 Hanya admin bisa CRUD komik
    $router->group(['middleware' => 'role:admin'], function () use ($router) {
        $router->post('komik', 'KomikController@store');
        $router->get('komik/{id}', 'KomikController@show');
        $router->put('komik/{id}', 'KomikController@update');
        $router->delete('komik/{id}', 'KomikController@destroy');
    });

    // 👤 Hanya user biasa bisa sewa
    $router->group(['middleware' => 'role:user'], function () use ($router) {
        $router->post('sewa', 'SewaController@store');
    });

    //$router->group(['middleware' => 'auth.jwt'], function () use ($router) {
    //$router->get('/user/profile', 'UserController@profile');
    //});

    $router->group(['middleware' => 'basic.auth'], function () use ($router) {
    $router->get('/komik', 'KomikController@index');
    $router->get('komik/{id}', 'KomikController@show');
    $router->post('/komik', ['middleware' => 'admin.only', 'uses' => 'KomikController@store']);
});
});*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // 🔓 Akses publik (tanpa login)
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->get('komik', 'KomikController@index');
    //$router->get('sewa', 'SewaController@index');

    // 🔐 Akses dengan Basic Auth
    $router->group(['middleware' => 'basic.auth'], function () use ($router) {

        // 👮 Akses admin
        $router->group(['middleware' => 'admin.only'], function () use ($router) {
            $router->post('komik', 'KomikController@store');
            $router->get('komik/{id}', 'KomikController@show');
            $router->put('komik/{id}', 'KomikController@update');
            $router->delete('komik/{id}', 'KomikController@destroy');
            $router->post('sewa', 'SewaController@store');
            $router->get('sewa', 'SewaController@index');
            $router->get('sewa/{id}', 'SewaController@show');
            $router->put('sewa/{id}', 'SewaController@update');
            $router->delete('sewa/{id}', 'SewaController@destroy');
        });

        // 👤 Akses user biasa
        $router->group(['middleware' => 'user.only'], function () use ($router) {
            $router->get('komik/{id}', 'KomikController@show');
            $router->post('sewa', 'SewaController@store');
        });

        // 🧑‍💼 Rute umum setelah login (baik admin maupun user)
        $router->get('profile', 'UserController@profile');
    });
});


