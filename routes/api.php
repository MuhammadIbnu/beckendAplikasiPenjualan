<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//agen
Route::apiResource('agen','Api\AgenController');
Route::get('search_agen','Api\AgenController@search');
//login pegawai
Route::post('login_pegawai', 'Api\PegawaiController@login_pegawai');
//kategori
Route::get('get_kategori','Api\KategoriController@get_all');
//produk
Route::post('get_produk', 'Api\ProdukController@get_produk_kategori');
//add cart
Route::post('add_cart', 'Api\TransaksiController@add_cart');
//get cart
Route::post('get_cart', 'Api\TransaksiController@get_cart');
//delete itemcart
Route::post('delete_item_cart', 'Api\TransaksiController@delete_item_cart');
//delete cart
Route::post('delete_cart','Api\TransaksiController@delete_cart' );
//checkout
Route::post('checkout','Api\TransaksiController@checkout');
//get transaksi
Route::post('get_transaksi','Api\TransaksiController@get_transaksi');
//getdetail
Route::post('get_detail_transaksi', 'Api\TransaksiController@get_detail_transaksi');