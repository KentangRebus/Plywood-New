<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () { return view('login.index');})->name('login');
Route::post('/login', 'LoginController@doLogin' )->name('do-login');


Route::group(['middleware' => ['auth']], function (){
    Route::get('/', 'DashboardController@index')->name('home');

//purchase routes
    Route::get('/product', 'ProductController@index')->name('product-view');
    Route::get('/product/add', 'ProductController@create')->name('product-insert-view');
    Route::get('/product/update/{id}', 'ProductController@edit')->name('product-update-view');

    Route::post('/product/add', 'ProductController@store')->name('product-insert');
    Route::post('/product/update/{id}', 'ProductController@update')->name('product-update');
    Route::post('/product/delete', 'ProductController@destroy')->name('product-delete');
    Route::post('/product/search', 'ProductController@show')->name('product-search');


//purchase routes
    Route::post('/product/autocomplete', 'SearchController@searchProduct')->name('product-autocomplete');
    Route::get('/purchase', 'PurchaseHeaderController@index')->name('purchase-view');
    Route::get('/purchase/add', 'PurchaseHeaderController@create')->name('purchase-insert-view');
    Route::get('/purchase/{id}', 'PurchaseHeaderController@show')->name('purchase-detail-view');

    Route::post('/purchase/add', 'PurchaseHeaderController@store')->name('purchase-insert');
    Route::post('/purchase/paid/{id}', 'PurchaseHeaderController@paid')->name('purchase-paid');
    Route::post('/purchase/delete', 'PurchaseHeaderController@destroy')->name('purchase-delete');


//transaction route
    Route::get('/transaction', 'TransactionHeaderController@index')->name('transaction-view');
    Route::get('/transaction/{id}', 'TransactionHeaderController@show')->name('transaction-detail');
    Route::get('/transaction/print/{id}', 'TransactionHeaderController@print')->name('transaction-print');

    Route::post('/transaction/add', 'TransactionHeaderController@store')->name('transaction-insert');
    Route::post('/transaction/delete', 'TransactionHeaderController@destroy')->name('transaction-delete');

//    category route
    Route::get('/category', 'CategoryController@index')->name('category-view');

//    customer route
    Route::get('/customer', 'CustomerController@index')->name('customer-view');
    Route::get('/customer/add', 'CustomerController@create')->name('customer-insert-view');
    Route::get('/customer/{id}', 'CustomerController@show')->name('customer-detail-view');
    Route::get('/customer/update/{id}', 'CustomerController@edit')->name('customer-update-view');

    Route::post('/customer/add', 'CustomerController@store')->name('customer-insert');
    Route::post('/customer/update/{id}', 'CustomerController@update')->name('customer-update');
    Route::post('/customer/delete/{id}', 'CustomerController@destroy')->name('customer-delete');

//    log out user
    Route::get('/logout', 'StaffController@logout')->name('logout');
});


