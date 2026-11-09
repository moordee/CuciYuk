<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\TransaksiController;


//routing-routing lama
Route::get('/def', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('layout.master');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/profil', function () {
    return view('profil');
});


// routing untuk mengakses laman dashboard
Route::get('/', [BerandaController::class, 'index']);

// routing untuk mengakses laman daftar jasa
Route::get('/jasa', [JasaController::class, 'index'])->name('jasa.index');

// routing untuk mengakses laman yang berisi form untuk menambahkan data ke daftar jasa
Route::get('/tambah_jasa', [JasaController::class, 'create']);

// routing untuk mengirim data form tambah jasa ke database
Route::post('/jasa/store', [JasaController::class, 'store'])->name('jasa.store');

// routing untuk menghapus data jasa dari database
Route::delete('/jasa/{id}', [JasaController::class, 'destroy'])->name('jasa.destroy');

// routing untuk mengakses laman yang berisi form untuk mengubah data yang ada di daftar jasa
Route::get('/ubah_jasa/{id}/edit', [JasaController::class, 'edit'])->name('jasa.edit');

// routing untuk mengirim data yang sudah di ubah ke daftar jasa
Route::put('/ubah_jasa/{id}', [JasaController::class, 'update'])->name('jasa.update');


// routing untuk mengakses laman transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

// routing untuk mengakses laman pencetakan struk transaksi
Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');

// routing untuk mengakses laman berisi form untuk menambahkan catatan transaksi
Route::get('/tambah_transaksi', [TransaksiController::class, 'create']);

// routing untuk mengirim data yang ada di form tambah transaksi
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');

// routing untuk menghapus data yang ada di daftar transaksi
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

// routing untuk mengakses laman berisi form untuk mengubah catatan transaksi
Route::get('/ubah_transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');

// routing untuk mengirim data yang ada di form ubah transaksi
Route::put('/ubah_transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');



//routing-routing lama untuk mengakses laman-laman bawaan template sb_admin
Route::get('/charts', function () {
    return view('charts');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/password', function () {
    return view('password');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/tables', function () {
    return view('tables');
});

Route::get('/sidenav-light', function () {
    return view('layout-sidenav-light');
});

Route::get('/static', function () {
    return view('layout-static');
});

Route::get('/401', function () {
    return view('401');
});

Route::get('/404', function () {
    return view('404');
});

Route::get('/500', function () {
    return view('500');
});
