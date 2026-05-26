<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController; // Modul Pemesanan

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Jalur Cek Sistem
Route::get('/tes-api', function () {
    return response()->json(['message' => 'API Sistem B2B Fashion Berjalan Baik']);
});

// ==========================================
// 1. Modul Produk (Risne) - FULL CRUD API
// ==========================================
Route::get('/products/view', [ProductController::class, 'index']);
Route::get('/products', [ProductController::class, 'apiIndex']);
Route::post('/products', [ProductController::class, 'apiStore']);
Route::get('/products/{id}', [ProductController::class, 'apiShow']);
Route::put('/products/{id}', [ProductController::class, 'apiUpdate']);
Route::delete('/products/{id}', [ProductController::class, 'apiDestroy']);

// ==========================================
// 2. Modul Pelanggan (Awin / Kapten) - FULL CRUD API
// ==========================================
// Rute untuk nampilin halaman HTML-nya:
Route::get('/pelanggan/view', [PelangganController::class, 'index']); 
// Rute untuk proses tarik, tambah, edit, dan hapus data (Fetch JSON):
Route::get('/pelanggan', [PelangganController::class, 'apiIndex']);
Route::post('/pelanggan', [PelangganController::class, 'apiStore']);
Route::put('/pelanggan/{id}', [PelangganController::class, 'apiUpdate']);
Route::delete('/pelanggan/{id}', [PelangganController::class, 'apiDestroy']);

// ==========================================
// 3. Modul Pembayaran (Miche)
// ==========================================
Route::get('/pembayaran/view', [PembayaranController::class, 'index']); 
Route::get('/pembayaran', [PembayaranController::class, 'apiIndex']);
Route::post('/pembayaran', [PembayaranController::class, 'apiStore']);
Route::put('/pembayaran/{id}', [PembayaranController::class, 'apiUpdate']);
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'apiDestroy']);

// ==========================================
// 4. Modul Pengiriman (Hedy)
// ==========================================
Route::get('/pengiriman', [PengirimanController::class, 'index']);

// ==========================================
// 5. Modul Pemesanan (Risti)
// ==========================================
Route::get('/pesanan/view', [PesananController::class, 'index']);
Route::get('/pesanan', [PesananController::class, 'apiIndex']);
Route::post('/pesanan', [PesananController::class, 'apiStore']);
Route::get('/pesanan/{id}', [PesananController::class, 'apiShow']);
Route::put('/pesanan/{id}', [PesananController::class, 'apiUpdate']);
Route::delete('/pesanan/{id}', [PesananController::class, 'apiDestroy']);