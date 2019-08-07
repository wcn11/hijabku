<?php

Route::group(['namespace' => 'Member'], function() {
    Route::get('/', 'HomeController@index')->name('member.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('member.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('member.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('member.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('member.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('member.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('member.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('member.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('member.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('member.verification.verify');

    Route::group(['middleware' => ['member.auth', "member.jatuh_tempo"]], function(){

        Route::post("data/keranjang", "HomeController@data_keranjang");
        Route::post("data/invoice", "HomeController@data_invoice");
        Route::post("data/history", "HomeController@data_history");
        Route::get("invoice/lihat/bukti/menunggu/{kode_invoice}", "HomeController@lihat_bukti_menunggu");
        Route::get("invoice/lihat/bukti/history/{kode_invoice}", "HomeController@lihat_bukti_history");
        

        Route::post("keranjang/update", "HomeController@update_keranjang");
        Route::post("keranjang/ambildata", "HomeController@ambildata");
        Route::post("keranjang/keluarkan", "HomeController@keluarkan");
        Route::post('/tambah_keranjang/{kode_barang}', "HomeController@tambah_keranjang");
        Route::get('/detail_barang/{kode_barang}', "HomeController@detail_barang")->name('detail_barang');
        
        Route::post("invoice", "HomeController@invoice");
        Route::post("invoice/tambah_barang", "HomeController@tambah_barang");
        Route::get("invoice/bayar/{kode_invoice}", "HomeController@bayar")->name('member.isi_invoice');
        Route::post("invoice/konfirmasi/{kode_invoice}", "HomeController@konfirmasi")->name("member.konfirmasi_invoice");
        Route::get("invoice/lihat/{kode_invoice}", "HomeController@lihat_invoice")->name("member.lihat_invoice");
        Route::get("invoice/print/{kode_invoice}", "HomeController@print_invoice")->name("member.print_invoice");
        Route::get("invoice/hapus/{kode_invoice}", "HomeController@hapus_invoice")->name("member.hapus_invoice");
        
        Route::get("konfirmasi/pembayaran", "HomeController@konfirmasi_pembayaran")->name("member.konfirmasi_pembayaran");
        Route::post("konfirmasi/upload", "HomeController@upload_bukti")->name("member.upload_bukti");
        Route::post("konfirmasi/update/bukti", "HomeController@update_bukti")->name("member.update_bukti");
    });
});