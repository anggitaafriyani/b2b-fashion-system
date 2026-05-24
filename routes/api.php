<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OrderController; // Modul Pemesanan

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Jalur Cek Sistem
Route::get('/tes-api', function () {
    return response()->json(['message' => 'API Sistem B2B Fashion Berjalan Baik']);
});

// Modul Produk (Rine)
Route::get('/products', [ProductController::class, 'index']);

// Modul Pembayaran (Miche)
Route::get('/pembayaran', [PembayaranController::class, 'index']);

// Modul Pengiriman (Hedy)
Route::get('/pengiriman', [PengirimanController::class, 'index']);

// Modul Pelanggan (Win)
Route::get('/pelanggan', [PelangganController::class, 'index']);

// Modul Pemesanan / Orders
Route::apiResource('orders', OrderController::class);