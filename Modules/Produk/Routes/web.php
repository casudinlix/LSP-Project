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

Route::group(['middleware' => ['auth', 'checkstatus'], 'prefix' => 'my'], function () {
    Route::resource('produk', 'ProdukController');
    Route::post('api/produk', 'ProdukController@list')->name('api.produk');
});
