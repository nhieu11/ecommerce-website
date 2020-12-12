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

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'client'], function() {

    //Route::view('login','client.auth.login');

    Route::group(['middleware' => 'guest:client'], function() {
        Route::get('login' , 'ClientLoginController@showLoginForm')->name('client.login');
        Route::post('login' , 'ClientLoginController@login');
    });

    Route::group(['middleware' => 'auth:client'], function() {
        Route::post('logout' ,'ClientLoginController@logout');
        Route::get('checkout','CartController@checkout');
        Route::post('checkout','CartController@postCheckout');
    });


    Route::get('','HomeController@index');
    Route::get('about','HomeController@about');
    Route::get('contact','HomeController@contact');


    Route::group(['prefix' => 'product'], function() {
        Route::get('','ProductController@index');
        Route::get('categorize_byID/{categorize}', 'ProductController@categorize_byID');
        Route::get('{product}','ProductController@detail');
    });

    Route::post('/check-coupon','CartController@check_coupon');
    Route::get('/unset-coupon','CartController@unset_coupon');

    Route::group(['prefix' => 'cart'], function() {
        Route::get('','CartController@index');
        Route::post('add','CartController@add');
        Route::post('remove','CartController@remove');
        Route::post('update','CartController@update');
    });

});


Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'

], function () {
    Route::resources([
        'users'=> 'UserController',
        'categories'=> 'CategoryController'
    ]);


   Route::group(['middleware' => 'auth'], function() {
    Route::get('','DashboardController');

    Route::group(['prefix' => 'products'], function () {
        Route::get('', 'ProductController@index');
        Route::get('create', 'ProductController@create');
        Route::post('', 'ProductController@store');
        Route::get('{product}/edit', 'ProductController@edit');
        Route::put('{product}', 'ProductController@update');
        Route::delete('{product}', 'ProductController@destroy');
        Route::get('{product}', 'ProductController@show');
    });

    Route::group(['prefix' => 'orders'], function() {
        Route::get('','OrderController@index');
        Route::get('processed','OrderController@processed');
        Route::get('{order}/detail','OrderController@detail');
        Route::get('{order}','OrderController@update');
    });

        Route::post('logout','AdminLoginController@logout');
   });

   //Coupon
   Route::group(['prefix' => 'coupon'], function() {

        Route::get('/insert_coupon','CouponController@insert_coupon');
        Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
        Route::get('','CouponController@list_coupon');
        Route::post('/insert-coupon-code','CouponController@insert_coupon_code');
    });

    Route::group(['middleware' => 'guest'], function() {
        Route::get('login','AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('login','AdminLoginController@login');
    });

});
