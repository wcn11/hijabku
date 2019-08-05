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

Route::get('/', "IndexController@index");

// Route::get('/detail_barang/{kode_barang}', "IndexController@detail_barang")->name('detail_barang');
// Route::post('/tambah_keranjang/{kode_barang}', "IndexController@tambah_keranjang");
