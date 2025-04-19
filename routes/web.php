<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('barang', BarangController::class);
Route::get('/penjualan', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
Route::get('/penjualan/{id}/cetak', [PenjualanController::class, 'cetak'])->name('penjualan.cetak');
Route::get('/penjualan/{id}/pdf', [PenjualanController::class, 'pdf'])->name('penjualan.pdf');
ROUTE::get('/penjualan/sukses/{id}', [PenjualanController::class, 'sukses'])->name('penjualan.sukses');

