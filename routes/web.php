<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/','products')->name('/');

Auth::routes(['verify'=>true]);


Route::group(['middleware' => ['auth','verified']], function () {
    Route::resource('user_addresses', 'UserAddressController');

    //收藏与取消收藏
    Route::post('products/{product}/favorite','ProductsController@favorite')->name('products.favorite');
    Route::delete('products/{product}/favorite','ProductsController@disFavorite')->name('products.disFavorite');

    //个人收藏页面
    Route::get('products/favorite','ProductsController@favoriteShow')->name('products.favoriteShow');

    //购物车
    Route::get('cart','CartsController@index')->name('cart.index');
    Route::post('cart','CartsController@addCart')->name('cart.add');
    Route::delete('cart/{sku}','CartsController@destroy')->name('cart.destroy');
    Route::put('cart/{sku}','CartsController@update')->name('cart.update');

    //订单
    Route::post('orders','OrdersController@store')->name('orders.store');
    Route::get('orders','OrdersController@index')->name('orders.index');
    Route::get('orders/{order}','OrdersController@show')->name('orders.show');
    //订单评论
    Route::get('orders/{order}/review','OrdersController@review')->name('orders.review');
    Route::post('orders/{order}/review','OrdersController@sendReview')->name('orders.review');
    //确认收货
    Route::post('orders/{order}','OrdersController@received')->name('orders.received');
    //申请退款
    Route::post('orders/{order}/refund','OrdersController@appliedRefund')->name('orders.refund');
    //支付
    Route::get('payment/{order}/alipay','PaymentController@payByAlipay')->name('payment.alipay');
    //浏览器回调
    Route::get('payment/alipay/return','PaymentController@alipayReturn')->name('alipay.return');

    //优惠卷
    Route::get('coupons/{code}','CouponCodesController@show')->name('coupons.show');
});
    //服务器回调
    //服务器端回调的路由不能放到带有 auth 中间件的路由组中，因为支付宝的服务器请求不会带有认证信息。
    Route::post('payment/alipay/notify','PaymentController@alipayNotify')->name('alipay.notify');

//商品展示
Route::get('products','ProductsController@index')->name('products.index');
Route::get('products/{product}','ProductsController@show')->name('products.show');

