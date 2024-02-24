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

$router->post('login', ['uses' => 'LoginController@login']);
$router->post('register', ['uses' => 'LoginController@store']);

$router->group(['prefix' => 'shop'], function () use ($router) {
    $router->post('cek', ['uses' => 'CekController@store']);

    $router->post('product', ['uses' => 'ProductController@store']);
    $router->get('product/{id}', ['uses' => 'ProductController@show']);
    $router->get('product', ['uses' => 'ProductController@index']);
    $router->delete('product/{id}', ['uses' => 'ProductController@destroy']);
    $router->put('product/{id}', ['uses' => 'ProductController@update']);

    $router->get('category', ['uses' => 'CategoryController@index']);
    $router->post('category', ['uses' => 'CategoryController@store']);
    $router->put('category/{id}', ['uses' => 'CategoryController@update']);
    $router->delete('category/{id}', ['uses' => 'CategoryController@destroy']);

    $router->get('cart', ['uses' => 'CartController@index']);
    $router->post('cart', ['uses' => 'CartController@store']);
    $router->delete('cart/{id}', ['uses' => 'CartController@destroy']);
    $router->put('cart/{id}', ['uses' => 'CartController@update']);
});
