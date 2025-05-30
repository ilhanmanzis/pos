<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Kategori;
use App\Http\Controllers\KategoriPengeluaran;
use App\Http\Controllers\ManajemenUser;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\Pengeluaran;
use App\Http\Controllers\Produk;
use App\Http\Controllers\Profile;
use App\Http\Controllers\Retur;
use Illuminate\Support\Facades\Route;

Route::get('/', [Dashboard::class, 'home'])->name('home');

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    //manajemen user
    Route::get('/users', [ManajemenUser::class, 'index'])->name('users');
    Route::get('/users/create', [ManajemenUser::class, 'create'])->name('users.create');
    Route::post('/users', [ManajemenUser::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [ManajemenUser::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [ManajemenUser::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [ManajemenUser::class, 'destroy'])->name('users.delete');

    //setting
    Route::get('/setting', [Profile::class, 'index'])->name('setting');
    Route::put('/setting', [Profile::class, 'update'])->name('setting.update');

    //data pelanggan
    Route::get('/pelanggans', [Pelanggan::class, 'index'])->name('pelanggan');
    Route::get('/pelanggans/create', [Pelanggan::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggans/store', [Pelanggan::class, 'store'])->name('pelanggan.store');
    Route::get('/pelanggans/{id}', [Pelanggan::class, 'show'])->name('pelanggan.show');
    Route::put('/pelanggans/update/{id}', [Pelanggan::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggans/store/{id}', [Pelanggan::class, 'destroy'])->name('pelanggan.delete');
});


//finance
Route::middleware(['auth', 'role:finance'])->prefix('finance')->as('finance.')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'finance'])->name('dashboard');

    //katgori Pengeluaran
    Route::get('/kategori', [KategoriPengeluaran::class, 'index'])->name('kategori');
    Route::get('/kategori/create', [KategoriPengeluaran::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriPengeluaran::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}', [KategoriPengeluaran::class, 'show'])->name('kategori.show');
    Route::put('/kategori/update/{id}', [KategoriPengeluaran::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/store/{id}', [KategoriPengeluaran::class, 'destroy'])->name('kategori.delete');

    //Pengeluaran
    Route::get('/pengeluaran', [Pengeluaran::class, 'index'])->name('pengeluaran');
    Route::get('/pengeluaran/create', [Pengeluaran::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran/store', [Pengeluaran::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{id}', [Pengeluaran::class, 'show'])->name('pengeluaran.show');
    Route::put('/pengeluaran/update/{id}', [Pengeluaran::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/store/{id}', [Pengeluaran::class, 'destroy'])->name('pengeluaran.delete');
});

//gudang
Route::middleware(['auth', 'role:gudang'])->prefix('gudang')->as('gudang.')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'gudang'])->name('dashboard');

    //produk
    Route::get('/produks', [Produk::class, 'index'])->name('produk');
    Route::get('/produk/{id}/stoks', [Produk::class, 'stok'])->name('produk.stok');
    Route::get('/produks/create', [Produk::class, 'create'])->name('produk.create');
    Route::post('/produks/store', [Produk::class, 'store'])->name('produk.store');
    Route::get('/produks/edit/{id}', [Produk::class, 'show'])->name('produk.show');
    Route::get('/produks/tambah/{id}', [Produk::class, 'tambah'])->name('produk.tambah');
    Route::get('/produks/{id}', [Produk::class, 'detail'])->name('produk.detail');
    Route::put('/produks/update/{id}', [Produk::class, 'update'])->name('produk.update');
    Route::put('/produks/updatestok/{id}', [Produk::class, 'editStok'])->name('produk.update.stok');
    Route::delete('/produks/delete/{id}', [Produk::class, 'destroy'])->name('produk.delete');


    //retur

    Route::get('/returs', [Retur::class, 'index'])->name('retur');
    Route::get('/returs/create', [Retur::class, 'create'])->name('retur.create');
    Route::post('/returs/store', [Retur::class, 'store'])->name('retur.store');
    Route::get('/returs/edit/{id}', [Retur::class, 'show'])->name('retur.show');
    Route::get('/returs/tambah/{id}', [Retur::class, 'tambah'])->name('retur.tambah');
    Route::put('/returs/updatestok/{id}', [Retur::class, 'editStok'])->name('retur.update.stok');
    Route::put('/returs/update/{id}', [Retur::class, 'update'])->name('retur.update');
    Route::delete('/returs/delete/{id}', [Retur::class, 'destroy'])->name('retur.delete');
    Route::get('/returs/{id}', [Retur::class, 'detail'])->name('retur.detail');

    //katgori produk
    Route::get('/kategori', [Kategori::class, 'index'])->name('kategori');
    Route::get('/kategori/create', [Kategori::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [Kategori::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}', [Kategori::class, 'show'])->name('kategori.show');
    Route::put('/kategori/update/{id}', [Kategori::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/store/{id}', [Kategori::class, 'destroy'])->name('kategori.delete');
});


Route::middleware(['auth', 'role:admin,finance,gudang'])->group(
    function () {
        //edit akun
        Route::get('/users/edit/{id}', [ManajemenUser::class, 'edit'])->name('users.edit');
        Route::put('/users/edit/{id}', [ManajemenUser::class, 'updateProfile'])->name('users.update.profile');
    }
);

Route::get('/login', [Auth::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [Auth::class, 'store'])->name('auth.login');
Route::get('/logout', [Auth::class, 'destroy'])->name('logout');
