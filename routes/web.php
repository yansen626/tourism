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

// Login Frontend
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/signin', 'Auth\LoginController@authenticate')->name('signin');

// Frontend Routing
Route::get('/', 'Frontend\HomeController@home')->name('landing');

//HTII Section Start

// Search
Route::get('search-form/', 'Frontend\HomeController@SearchForm')->name('search');
Route::get('search/{key}', 'Frontend\HomeController@SearchResult')->name('search-result');

//Traveler
Route::prefix('traveler')->group(function(){
    Route::get('/', 'Frontend\TravelerController@index')->name('traveller-index');
    Route::get('/transactions', 'Frontend\TravelerController@TransactionLists')->name('traveller-transactions');
});\


//HTII Section End



// Terms and Condition
Route::get('/terms', 'Frontend\HomeController@terms')->name('terms-show');

// Product
Route::get('product/category/{categoryId}-{categoryName}', 'Frontend\ProductsController@products')->name('products');
Route::get('product-detail/{id}', 'Frontend\ProductsController@ProductShow')->name('product-detail');
Route::get('search/{key}', 'Frontend\ProductsController@search')->name('product-search');


// Cart
Route::get('cart', 'Frontend\CartController@CartShowAll')->name('cart-list');
Route::post('/add-cart', [
    'uses' => 'Frontend\CartController@AddToCart',
    'as' => 'addCart'
]);
Route::get('delete-cart/{cartId}', 'Frontend\CartController@DeleteCart')->name('delete-cart');
Route::post('/edit-cart', [
    'uses' => 'Frontend\CartController@EditQuantityCart',
    'as' => 'editCart'
]);
Route::get('cart/check/{id}', 'Frontend\CartController@getNotes');
Route::post('cart/add/check', 'Frontend\CartController@checkNoteForCartAdd')->name('cart-add-check-note');
Route::post('cart/save/note', 'Frontend\CartController@storeNotes');

// Gallery
Route::get('gallery/{id}', 'Frontend\GalleryController@index')->name('frontend-gallery-show');

// Payment
Route::get('checkout-1', 'Frontend\TransactionController@CheckoutProcess1')->name('checkout');
Route::get('checkout-2', 'Frontend\TransactionController@CheckoutProcess2')->name('checkout2');
Route::post('/checkout2-submit', [
    'uses' => 'Frontend\TransactionController@CheckoutProcess2Submit',
    'as' => 'checkout2Submit'
]);
Route::get('checkout-3', 'Frontend\TransactionController@CheckoutProcess3')->name('checkout3');
Route::get('checkout-4', 'Frontend\TransactionController@CheckoutProcess4')->name('checkout4');
Route::get('checkout-success/{userId}', 'MidtransController@success');
Route::get('checkout-failed', 'Frontend\TransactionController@CheckoutProcessFailed')->name('checkout-failed');
Route::get('checkout-bank-account/{invoice}', 'Frontend\TransactionController@CheckoutProcessBankAccount')->name('checkout-bank-account');
Route::get('checkout-bank/{invoice}', 'Frontend\TransactionController@CheckoutProcessBank')->name('checkout-bank');
Route::post('/checkout-bank-submit', [
    'uses' => 'Frontend\TransactionController@CheckoutProcessBankSubmit',
    'as' => 'checkoutBankSubmit'
]);
Route::post('/checkout-mid', [
    'uses' => 'MidtransController@checkoutMidtrans',
    'as' => 'checkoutMid'
]);
Route::post('/checkout-notification', [
    'uses' => 'MidtransController@notification',
    'as' => 'checkoutNotification'
]);
Route::get('checkout/success/{paymentMethod}', 'MidtransController@checkoutSuccess')->name('checkout-success');
// End Frontend Routing

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

// User Data
Route::prefix('user')->group(function(){
    Route::get('/', 'Frontend\UserController@index')->name('user-profile');
    Route::get('/edit', 'Frontend\UserController@edit')->name('user-edit');
    Route::post('/edit/save', 'Frontend\UserController@update');
    Route::get('/password/edit', 'Frontend\UserController@passwordChange')->name('password-edit');
    Route::post('/password/save', 'Frontend\UserController@passwordUpdate');
});

//User Address
Route::prefix('user/address')->group(function(){
    Route::get('/create', 'Frontend\UserAddressController@create')->name('user-address-create');
    Route::post('/create/save', 'Frontend\UserAddressController@store')->name('user-address-store');
    Route::get('/edit', 'Frontend\UserAddressController@edit')->name('user-address-edit');
    Route::post('/edit/update', 'Frontend\UserAddressController@update')->name('user-address-update');
});

// Purchasing
Route::prefix('purchase')->group(function(){
   Route::get('/payment', 'Frontend\PurchaseController@payment')->name('user-payment-list');
    Route::get('/order', 'Frontend\PurchaseController@order')->name('user-order-list');
    Route::get('/history', 'Frontend\PurchaseController@history')->name('user-order-history-list');
});
Route::get('invoice/{id}','Frontend\PurchaseController@invoice')->name('invoice-view');

// End Frontend Routing


// Rajaongkir
Route::get('rajaongkir/subdistrict/{cityId}', 'Frontend\UserAddressController@getSubdistrict');

// Backend Routing
Route::get('/HTII-Travelmate', 'Admin\DashboardController@dashboardShow')->name('admin-dashboard');

Route::get('/HTII/login', function (){
    return view('admin/login');
})->name('login-admin');

Route::get('/HTII/login/{failed}', function ($failed){
    $msg = "Not Found!";
    return view('admin/login')->with('msg', $msg);
})->name('login-admin-failed');

// User
Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin-dashboard');
Route::post('/HTII-Travelmate', 'Auth\LoginAdminController@login');
Route::get('/admin/logout', 'Auth\LoginAdminController@logout')->name('admin-logout');

//traveller
Route::prefix('admin/traveller')->group(function(){
    Route::get('/', 'Admin\TravellerController@index')->name('traveller-list');
    Route::get('/{customerId}/transactions', 'Admin\TravellerController@transactions')->name('traveller-transaction-list');
});

// Voucher
Route::prefix('admin/voucher')->group(function(){
    Route::get('/', 'Admin\VoucherController@index')->name('voucher-list');
    Route::post('/', 'Admin\VoucherController@store');
    Route::get('/create', 'Admin\VoucherController@create')->name('voucher-create');
    Route::get('/edit/{id}', 'Admin\VoucherController@edit');
    Route::post('/{id}', 'Admin\VoucherController@update');
});

//rate
Route::prefix('admin/rate')->group(function(){
    Route::get('/edit', 'Admin\RateController@edit')->name('rate-edit');
    Route::post('/edit', 'Admin\RateController@update');
});


// Product
Route::prefix('/admin/product')->group(function (){
    Route::get('/', 'Admin\ProductController@index')->name('product-list');
    Route::post('/', 'Admin\ProductController@store')->name('product-store');
    Route::get('/create', 'Admin\ProductController@create')->name('product-create');
    Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('product-edit');
    Route::post('/{id}', 'Admin\ProductController@update');
});

// Product Property
Route::prefix('/admin/product')->group(function (){
    Route::get('/{productId}/{name}', 'Admin\ProductPropertyController@index')->name('product-property-list');
    Route::get('/{productId}/{name}/create', 'Admin\ProductPropertyController@create')->name('product-property-create');
    Route::post('/{productId}/{name}/store', 'Admin\ProductPropertyController@store');
    Route::get('/property/edit/{id}', 'Admin\ProductPropertyController@edit')->name('product-property-edit');
    Route::post('/property/update/{id}', 'Admin\ProductPropertyController@update');
    Route::get('/property/delete/{id}', 'Admin\ProductPropertyController@delete')->name('product-property-delete');
});

// Transaction
Route::prefix('admin/transaction')->group(function(){
    Route::get('/', 'Admin\TransactionController@index')->name('transaction-list');
    Route::get('/detail/{id}', 'Admin\TransactionController@detail')->name('transaction-detail');
});
Route::get('/admin/neworder', 'Admin\TransactionController@newOrder')->name('new-order-list');
Route::get('/admin/neworder/accept/{id}', 'Admin\TransactionController@acceptOrder')->name('new-order-accept');
Route::post('/admin/neworder/reject', 'Admin\TransactionController@rejectOrder')->name('new-order-accept');
Route::get('/admin/payment', 'Admin\TransactionController@payment')->name('payment-list');
Route::get('/admin/payment/check', 'Admin\TransactionController@manualTransferPayment')->name('manual-transfer-payment-list');
Route::get('/admin/payment/cancel/{id}', 'Admin\TransactionController@cancelPayment');
Route::get('/admin/payment/confirm/{id}', 'Admin\TransactionController@confirmPayment')->name('payment-confirm');
Route::get('/admin/delivery', 'Admin\TransactionController@deliveryRequest')->name('delivery-list');
Route::post('/admin/delivery/confirm', 'Admin\TransactionController@confirmDelivery')->name('delivery-confirm');
Route::get('/track/{id}', 'RajaOngkirController@track')->name('track');
Route::get('/invoice/{trxId}', 'Admin\TransactionController@invoice')->name('admin-invoice');

// Slider Banner
Route::prefix('/admin/banner/slider')->group(function(){
    Route::get('/{type}', 'Admin\BannerController@index')->name('slider-banner-list');
    Route::post('/{type}', 'Admin\BannerController@store');
    Route::get('/create/{type}', 'Admin\BannerController@create')->name('slider-banner-create');
    Route::get('/edit/{id}', 'Admin\BannerController@edit')->name('slider-banner-edit');
    Route::post('/update/{id}', 'Admin\BannerController@update');
    Route::get('/delete/{id}', 'Admin\BannerController@delete');
});

// Top Banner
Route::prefix('/admin/banner/top')->group(function(){
    Route::get('/', 'Admin\BannerController@topBannerIndex')->name('top-banner-list');
    Route::get('/edit/{id}', 'Admin\BannerController@topBannerEdit')->name('top-banner-edit');
    Route::post('/update/{id}', 'Admin\BannerController@topBannerUpdate');
});

// Category
Route::prefix('admin/category')->group(function(){
    Route::get('/', 'Admin\CategoryController@index')->name('category-list');
    Route::post('/', 'Admin\CategoryController@store');
    Route::get('/create', 'Admin\CategoryController@create')->name('category-create');
    Route::get('/edit/{id}', 'Admin\CategoryController@edit');
    Route::post('/{id}', 'Admin\CategoryController@update');
});

// Gallery
Route::prefix('admin/gallery')->group(function(){
    Route::get('/', 'Admin\GalleryController@index')->name('gallery-list');
    Route::post('/save', 'Admin\GalleryController@store');
    Route::get('/create', 'Admin\GalleryController@create')->name('gallery-create');
    Route::get('/edit/{id}', 'Admin\GalleryController@edit')->name('gallery-edit');
    Route::post('/update/{id}', 'Admin\GalleryController@update');
    Route::get('/delete/{id}', 'Admin\GalleryController@delete');
});

// Gallery Image
Route::prefix('admin/gallery')->group(function(){
    Route::get('/{galleryId}/image', 'Admin\GalleryController@imageIndex')->name('gallery-image-list');
    Route::post('/{galleryId}/store', 'Admin\GalleryController@imageStore');
    Route::get('/{galleryId}/create', 'Admin\GalleryController@imageCreate')->name('gallery-image-create');
    Route::get('/{galleryId}/edit/{id}', 'Admin\GalleryController@imageEdit')->name('gallery-image-edit');
    Route::post('/{galleryId}/update/{id}', 'Admin\GalleryController@imageUpdate');
    Route::get('/{galleryId}/delete/{id}', 'Admin\GalleryController@imageDelete')->name('gallery-image-delete');
});

// Paymentmethods
Route::prefix('admin/paymentmethods')->group(function(){
    Route::get('/', 'Admin\PaymentMethodController@index')->name('payment-method-show');
    Route::post('/', 'Admin\PaymentMethodController@store');
    Route::get('/create', 'Admin\PaymentMethodController@create')->name('payment-method-create');
    Route::get('/edit/{id}', 'Admin\PaymentMethodController@edit');
    Route::post('/{id}', 'Admin\PaymentMethodController@update');
    Route::get('/delete/{id}', 'Admin\PaymentMethodController@destroy');
});

// Courier
Route::prefix('admin/courier')->group(function(){
    Route::get('/', 'Admin\CourierController@index')->name('courier-list');
    Route::post('/', 'Admin\CourierController@store');
    Route::get('/create', 'Admin\CourierController@create')->name('courier-create');
    Route::get('/edit/{id}', 'Admin\CourierController@edit');
    Route::post('/{id}', 'Admin\CourierController@update');
    Route::get('/delete/{id}', 'Admin\CourierController@destroy');
});

// Delivery Type
Route::prefix('admin/delivery-type')->group(function(){
    Route::get('/', 'Admin\DeliveryTypeController@index')->name('delivery-type-list');
    Route::post('/', 'Admin\DeliveryTypeController@store');
    Route::get('/create', 'Admin\DeliveryTypeController@create')->name('delivery-type-create');
    Route::get('/edit/{id}', 'Admin\DeliveryTypeController@edit');
    Route::post('/{id}', 'Admin\DeliveryTypeController@update');
    Route::get('/delete/{id}', 'Admin\DeliveryTypeController@destroy');
});

// Status
Route::prefix('admin/status')->group(function(){
    Route::get('/', 'Admin\StatusController@index')->name('status-list');
    Route::post('/', 'Admin\StatusController@store');
    Route::get('/create', 'Admin\StatusController@create')->name('status-create');
    Route::get('/edit/{id}', 'Admin\StatusController@edit');
    Route::post('/{id}', 'Admin\StatusController@update');
    Route::get('/delete/{id}', 'Admin\StatusController@destroy');
});

// Admin Options
Route::get('/admin/option/address', 'Admin\OptionController@index')->name('store-address');
Route::post('/admin/option/address/save', 'Admin\OptionController@update');
Route::get('/admin/option/city', 'Admin\OptionController@getCities');
Route::get('/admin/option/subdistrict', 'Admin\OptionController@getSubdistricts');

// Report
Route::prefix('admin/report')->group(function(){
    Route::get('/form', 'Admin\ReportController@index')->name('report-form');
    Route::post('/', 'Admin\ReportController@request');
});

// Admin
Route::prefix('admin/user')->group(function(){
    Route::get('/list', 'Admin\UserController@index')->name('admin-list');
    Route::get('/show/{id}', 'Admin\UserController@show')->name('admin-show');
    Route::get('/edit/{id}', 'Admin\UserController@edit')->name('admin-edit');
    Route::post('/save/{id}', 'Admin\UserController@update');
    Route::get('/password/{id}', 'Admin\UserController@passwordEdit')->name('admin-password-edit');
    Route::post('/password/save/{id}', 'Admin\UserController@passwordUpdate');
});

// End Backend Routing


Route::get('/home', 'HomeController@index')->name('home');
