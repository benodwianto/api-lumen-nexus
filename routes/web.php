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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('home', ['uses' => 'HomeController@index']);
$router->get('user', ['uses' => 'HomeController@index']);

//login dan register
$router->get('login', ['uses' => 'LoginController@index']);
$router->post('login', ['uses' => 'LoginController@login']);
$router->post('register', ['uses' => 'LoginController@store']);
$router->post('logout', ['uses' => 'LoginController@logout']);


$router->group(['prefix' => 'nexus', 'middleware' => 'auth'], function () use ($router) {
    //user
    $router->put('user/{id}', ['uses' => 'UserController@update']);
    $router->delete('user/{id}', ['uses' => 'UserController@destroy']);
    $router->get('user', ['uses' => 'UserController@index']);

    //searching
    $router->post('search', ['uses' => 'HomeController@search']);

    //daftar bengkel
    $router->post('daftarbengkel', ['uses' => 'BengkelController@store']);
    $router->group(['middleware' => 'admin'], function () use ($router) {
        //mitra bengkel
        $router->get('bengkel', ['uses' => 'BengkelController@index']);
        $router->put('bengkel/{id}', ['uses' => 'BengkelController@update']);
        $router->get('bengkel/{bengkel}', ['uses' => 'BengkelController@show']);
        $router->post('bengkel/{id}/rating', ['uses' => 'BengkelController@rateBengkel']);

        //produk
        $router->post('produk', ['uses' => 'ProductController@store']);
        $router->get('produk/{id}', ['uses' => 'ProductController@show']);
        $router->get('produk', ['uses' => 'ProductController@index']);
        $router->delete('produk/{id}', ['uses' => 'ProductController@destroy']);
        $router->put('produk/{id}', ['uses' => 'ProductController@update']);
    });

    //cek motor
    $router->post('cek', ['uses' => 'CekController@store']);
    $router->delete('cek/{id}', ['uses' => 'CekController@destroy']);
    $router->put('cek/{id}', ['uses' => 'CekController@update']);
    $router->get('cek/{id}', ['uses' => 'CekController@show']);
    $router->get('cek', ['uses' => 'CekController@index']);

    //komentar
    $router->get('komentar/bengkel', ['uses' => 'ComentController@index']);
    $router->post('bengkel/{id}/komen', ['uses' => 'ComentController@store']);
    $router->put('bengkel/{id}/komen', ['uses' => 'ComentController@update']);
    $router->delete('bengkel/{id}/komen', ['uses' => 'ComentController@destroy']);

    //kategori
    $router->get('kategori', ['uses' => 'CategoryController@index']);
    $router->post('kategori', ['uses' => 'CategoryController@store']);
    $router->put('kategori/{id}', ['uses' => 'CategoryController@update']);
    $router->delete('kategori/{id}', ['uses' => 'CategoryController@destroy']);
});
