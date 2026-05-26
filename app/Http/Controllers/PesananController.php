<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // =========================
    // UI (tampilan halaman)
    // =========================
    public function index()
    {
        return view('pesanan');
    }

    // =========================
    // READ (ambil semua data)
    // =========================
    public function apiIndex()
    {
        $orders = Order::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $orders
        ]);
    }

    // =========================
    // CREATE (tambah data)
    // =========================
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'produk' => 'required',
            'jumlah' => 'required|numeric',
            'status' => 'required'
        ]);

        $order = Order::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesanan berhasil ditambahkan',
            'data' => $order
        ]);
    }

    // =========================
    // UPDATE (edit data)
    // =========================
    public function apiUpdate(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'produk' => 'required',
            'jumlah' => 'required|numeric',
            'status' => 'required'
        ]);

        $order->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesanan berhasil diupdate',
            'data' => $order
        ]);
    }

    // =========================
    // DELETE (hapus data)
    // =========================
    public function apiDestroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pesanan berhasil dihapus'
        ]);
    }
}