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

Route::get('/', function () {
    return view('dashboard.index');
})->name('home');


Route::get('/product', 'ProductController@index')->name('product-view');
Route::get('/product/add', 'ProductController@create')->name('product-insert-view');
Route::get('/product/update/{id}', 'ProductController@edit')->name('product-update-view');

Route::post('/product/add', 'ProductController@store')->name('product-insert');
Route::post('/product/update/{id}', 'ProductController@update')->name('product-update');
Route::post('/product/delete', 'ProductController@destroy')->name('product-delete');
Route::post('/product/search', 'ProductController@show')->name('product-search');

Route::post('/product/autocomplete', 'SearchController@searchProduct')->name('product-autocomplete');

Route::get('/purchase', 'PurchaseHeaderController@index')->name('purchase-view');
Route::get('/purchase/add', 'PurchaseHeaderController@create')->name('purchase-insert-view');
Route::get('/purchase/{id}', 'PurchaseHeaderController@show')->name('purchase-detail-view');

Route::post('/purchase/add', 'PurchaseHeaderController@store')->name('purchase-insert');
Route::post('/purchase/paid/{id}', 'PurchaseHeaderController@paid')->name('purchase-paid');

