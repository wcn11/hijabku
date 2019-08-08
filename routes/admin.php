<?php

Route::group(['namespace' => 'Admin'], function() {
    Route::get('/', 'HomeController@index')->name('admin.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('admin.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('admin.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('admin.verification.verify');

    Route::group(['middleware' => ['admin.auth']], function(){

        Route::get("barang", "BarangController@index")->name("admin.barang");
        Route::post("barang/tambah", "BarangController@tambah_barang")->name("admin.tambah_barang");
        Route::post("barang/hapus/{kode_barang}", "BarangController@hapus_barang")->name("admin.hapus_barang");
        Route::post("barang/update", "BarangController@update_barang")->name("admin.update_barang");

        Route::get("kategori", 'KategoriController@index')->name('admin.kategori');
        Route::post("kategori/tambah", 'KategoriController@tambah_kategori')->name('admin.tambah_kategori');
        Route::post("kategori/hapus/{kode_kategori}", 'KategoriController@hapus_kategori')->name('admin.hapus_kategori');
        Route::post("kategori/update", 'KategoriController@update_kategori')->name('admin.update_kategori');

        Route::get("member", "MemberController@index")->name("admin.member");
        Route::post("member/hapus/{id_member}", "MemberController@hapus_member")->name("admin.hapus_member");

        Route::get("konfirmasi", "HomeController@konfirmasi")->name("admin.konfirmasi");
        Route::get("konfirmasi/tolak/{kode_invoice}", "HomeController@tolak_konfirmasi")->name("admin.tolak_konfirmasi");
        Route::get("konfirmasi/terima/{kode_invoice}", "HomeController@terima_konfirmasi")->name("admin.terima_konfirmasi");
        
        Route::get("laporan", "HomeController@laporan")->name("admin.laporan");

    });

});