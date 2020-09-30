<?php
use RealRashid\SweetAlert\Facades\Alert;
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
    
    return redirect('login');
   
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//ketika ada yang redirect ke register maka akan dia arahkan ke login
Route::match(['get', 'post'], '/register', function () {
    return redirect('login');
});
//menu
//user
Route::resource('user', 'UserController');
//supplier
Route::resource('supplier', 'SupplierController')->except(['show']);
//pegawai
Route::resource('pegawai', 'PegawaiController')->except(['show']);
//kategori
Route::resource('kategori', 'KategoriController')->except(['show']);
//produk
Route::resource('produk', 'ProdukController')->except(['show']);
//transaksi
Route::resource('transaksi_masuk', 'TransaksiMasukController')->only(['create','index','store','destroy']);
//agen
Route::get('agen','AgenController@index')->name('agen');
//report penjualan
Route::get('report_penjualan', 'ReportPenjualanController@index')->name('report_penjualan');
//cetak pdf
Route::get('cetak_pdf','ReportPenjualanController@cetak_pdf')->name('cetak_pdf');
//cetak excel
Route::get('cetak_excel','ReportPenjualanController@cetak_excel')->name('cetak_excel');