<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->get('users','UserController@index'); //管理用户

    $router->get('products','ProductsController@index'); //管理商品

    //新建商品
    $router->get('products/create','ProductsController@create');
    $router->post('products','ProductsController@store');

    //编辑商品
    $router->get('products/{id}/edit','ProductsController@edit');
    $router->put('products/{id}','ProductsController@update');

});