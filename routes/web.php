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

// Frontend Routing
Route::get('/', 'Frontend\HomeController@home');

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

Route::get('/admin/logout', 'Auth\LoginAdminController@logout');

//Paymentmethods
Route::get('/admin/paymentmethods', 'Admin\PaymentMethodController@index');
Route::get('/admin/paymentmethods/create', 'Admin\PaymentMethodController@create');
Route::post('/admin/paymentmethods', 'Admin\PaymentMethodController@store');
Route::get('/admin/paymentmethods/edit/{id}', 'Admin\PaymentMethodController@edit');
Route::post('/admin/paymentmethods/{id}', 'Admin\PaymentMethodController@update');
Route::get('/admin/paymentmethods/delete/{id}', 'Admin\PaymentMethodController@destroy');

// End Backend Routing