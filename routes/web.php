<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\PenyimpananBarangController;
use App\Http\Controllers\PermintaanBarangController;
use App\Http\Controllers\PengemasanBarangController;
use App\Http\Controllers\PengirimanBarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::middleware(['auth', 'cekrole:petugas_penerimaan'])->group(function () {
    Route::resource('penerimaan_barang', PenerimaanBarangController::class)->only(['index']);
});


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::resource('penerimaan_barang', PenerimaanBarangController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('penyimpanan_barang', PenyimpananBarangController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('permintaan_barang', PermintaanBarangController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('pengemasan_barang', PengemasanBarangController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('pengiriman_barang', PengirimanBarangController::class);
});

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';