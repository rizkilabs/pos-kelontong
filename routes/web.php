<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::get('/penjualan', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::get('/penjualan/{id}/cetak', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');
    Route::get('/penjualan/{id}/pdf', [PenjualanController::class, 'pdf'])->name('penjualan.pdf');
    Route::get('/penjualan/sukses/{id}', [PenjualanController::class, 'sukses'])->name('penjualan.sukses');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

});





