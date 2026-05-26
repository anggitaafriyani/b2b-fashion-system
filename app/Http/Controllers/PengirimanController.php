<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;

class PengirimanController extends Controller
{
    // Render Halaman Utama Blade
    public function index()
    {
        return view('pengiriman');
    }

    // API: Ambil Semua Data Pengiriman
    public function apiIndex()
    {
        $pengiriman = Pengiriman::orderBy('created_at', 'desc')->get();
        
        // Diubah menjadi berformat objek array agar terbaca oleh JavaScript di Blade
        return response()->json([
            'data' => $pengiriman
        ], 200);
    }

    // API: Simpan Data Baru
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'kode_pesanan'     => 'required|string|max:255',
            'nama_pelanggan'   => 'required|string|max:255',
            'ekspedisi'        => 'required|string|max:255',
            'no_resi'          => 'nullable|string|max:255',
            'ongkir'           => 'required|numeric|min:0',
            'status_pengiriman'=> 'required|string',
        ]);

        $pengiriman = Pengiriman::create($validated);

        return response()->json([
            'message' => 'Data pengiriman berhasil ditambahkan!',
            'data'    => $pengiriman
        ], 201);
    }

    // API: Ubah Data
    public function apiUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_pesanan'     => 'required|string|max:255',
            'nama_pelanggan'   => 'required|string|max:255',
            'ekspedisi'        => 'required|string|max:255',
            'no_resi'          => 'nullable|string|max:255',
            'ongkir'           => 'required|numeric|min:0',
            'status_pengiriman'=> 'required|string',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update($validated);

        return response()->json([
            'message' => 'Data pengiriman berhasil diperbarui!',
            'data'    => $pengiriman
        ], 200);
    }

    // API: Hapus Data
    public function apiDestroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();

        return response()->json([
            'message' => 'Data pengiriman berhasil dihapus!'
        ], 200);
    }
}
