<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
Route::get('/penjualan/reset', function () {
    session()->forget('cart');
    return redirect('/penjualan')->with('success', 'Keranjang dikosongkan');
});
    Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori/store', [KategoriController::class, 'store']);
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
Route::post('/kategori/{id}/update', [KategoriController::class, 'update']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

    Route::get('/produk', [ProductController::class, 'index']);
    Route::get('/produk/create', [ProductController::class, 'create']);
    Route::post('/produk/store', [ProductController::class, 'store']);
    Route::get('/produk/{id}/toggle', [ProductController::class, 'toggle']);
    Route::delete('/produk/{id}', [ProductController::class, 'destroy']);

    // 🔥 PENJUALAN
    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::post('/penjualan/tambah', [PenjualanController::class, 'tambah']);

    Route::post('/penjualan/plus/{id}', [PenjualanController::class, 'tambahQty']);
Route::post('/penjualan/minus/{id}', [PenjualanController::class, 'kurangQty']);
Route::post('/penjualan/hapus/{id}', [PenjualanController::class, 'hapus']);

    Route::post('/penjualan/bayar', [PenjualanController::class, 'bayar']);
    Route::get('/struk', function () {
    return view('penjualan.struk');
});



});



