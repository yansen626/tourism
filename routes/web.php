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

//Build in Routes for Auth
Auth::routes();

// Frontend Routing
Route::get('/', 'Frontend\HomeController@home')->name('landing');

/*Route::get('/login', function (){
    return view('frontend/login');
});

Route::get('/register', function (){
    return view('frontend/register');
});
Route::post('/register', 'Auth\RegisterController@create');*/

Route::get('/product-list', function (){
    return view('frontend/show-products');
})->name('product-list');
Route::get('/product-detail', function (){
    return view('frontend/show-product');
})->name('single-product');
Route::get('/cart', function (){
    return view('frontend/carts');
})->name('cart');
Route::get('/checkout-1', function (){
    return view('frontend/checkout-step1');
})->name('checkout');
Route::get('/checkout-2', function (){
    return view('frontend/checkout-step2');
})->name('checkout2');
Route::get('/checkout-3', function (){
    return view('frontend/checkout-step3');
})->name('checkout3');
Route::get('/checkout-4', function (){
    return view('frontend/checkout-step4');
})->name('checkout4');
// End Frontend Routing




// Backend Routing
Route::get('/admin', 'Admin\DashboardController@dashboardShow')->name('admin-dashboard');

Route::get('/lowids/login', function (){
    return view('admin/login');
})->name('login-admin');

Route::get('/lowids/login/{failed}', function ($failed){
    $msg = "Not Found!";
    return view('admin/login')->with('msg', $msg);
})->name('login-admin-failed');

Route::get('/admin/user', 'Admin\UserManagementController@index');

Route::get('/admin/product', 'Admin\ProductController@index');

Route::get('/admin/transaction', 'Admin\TransactionController@index');

Route::post('/admin/login-success', 'Auth\LoginAdminController@login');

Route::get('/admin', 'Admin\DashboardController@index')->name('admin-dashboard');

Route::get('/admin/logout', 'Auth\LoginAdminController@logout')->name('admin-logout');

// Product
Route::get('/admin/product', 'Admin\ProductController@index');
Route::get('/admin/product/create', function (){
    return view('admin/create-product');
})->name('product-create');

//Paymentmethods
Route::prefix('admin/paymentmethods')->group(function(){
    Route::get('/', 'Admin\PaymentMethodController@index');
    Route::post('/', 'Admin\PaymentMethodController@store');
    Route::get('/create', 'Admin\PaymentMethodController@create');
    Route::get('/edit/{id}', 'Admin\PaymentMethodController@edit');
    Route::post('/{id}', 'Admin\PaymentMethodController@update');
    Route::get('/delete/{id}', 'Admin\PaymentMethodController@destroy');
});

// End Backend Routing


Route::get('/home', 'HomeController@index')->name('home');
