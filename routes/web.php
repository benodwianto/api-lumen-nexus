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
    return $router->app->version();
});

$router->get('/register', 'LoginController@index');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('home', ['uses' => 'HomeController@index']);
    $router->get('user', ['uses' => 'HomeController@index']);
});

$router->get('login', ['uses' => 'LoginController@index']);
$router->post('login', ['uses' => 'LoginController@login']);
$router->post('register', ['uses' => 'LoginController@store']);

$router->group(['prefix' => 'nexus', 'middleware' => 'auth'], function () use ($router) {
    //user
    $router->put('user/{id}', ['uses' => 'UserController@update']);
    $router->delete('user/{id}', ['uses' => 'UserController@destroy']);

    //mitra bengkel
    $router->post('bengkel', ['uses' => 'BengkelController@store']);

    $router->post('cek', ['uses' => 'CekController@store']);

    $router->post('produk', ['uses' => 'ProductController@store']);
    $router->get('produk/{id}', ['uses' => 'ProductController@show']);
    $router->get('produk', ['uses' => 'ProductController@index']);
    $router->delete('produk/{id}', ['uses' => 'ProductController@destroy']);
    $router->put('produk/{id}', ['uses' => 'ProductController@update']);

    $router->get('category', ['uses' => 'CategoryController@index']);
    $router->post('category', ['uses' => 'CategoryController@store']);
    $router->put('category/{id}', ['uses' => 'CategoryController@update']);
    $router->delete('category/{id}', ['uses' => 'CategoryController@destroy']);

    $router->get('cart', ['uses' => 'CartController@index']);
    $router->post('cart', ['uses' => 'CartController@store']);
    $router->delete('cart/{id}', ['uses' => 'CartController@destroy']);
    $router->put('cart/{id}', ['uses' => 'CartController@update']);
});
