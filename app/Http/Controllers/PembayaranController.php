<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('pembayaran');
    }

    public function apiIndex()
    {
        $pembayaran = Pembayaran::latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $pembayaran
        ]);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required',
            'no_invoice' => 'required|unique:pembayarans,no_invoice',
            'total_tagihan' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'jumlah_dibayar' => 'numeric',
            'status_pembayaran' => 'required',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validasi file foto (maks 2MB)
        ]);

        // Proses simpan foto jika ada yang diupload
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bukti'), $filename);
            $validated['bukti_pembayaran'] = 'uploads/bukti/' . $filename;
        }

        $pembayaran = Pembayaran::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pembayaran berhasil ditambahkan',
            'data' => $pembayaran
        ]);
    }

    public function apiUpdate(Request $request, $id)
    {
        $pembayaran = Pembayaran::find($id);

        if(!$pembayaran){
            return response()->json([
                'status' => 'error',
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'pelanggan_id' => 'required',
            'no_invoice' => 'required|unique:pembayarans,no_invoice,'.$id,
            'total_tagihan' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'jumlah_dibayar' => 'numeric',
            'status_pembayaran' => 'required',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Proses ganti foto jika ada upload file baru
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus foto lama dari folder jika ada
            if ($pembayaran->bukti_pembayaran && file_exists(public_path($pembayaran->bukti_pembayaran))) {
                unlink(public_path($pembayaran->bukti_pembayaran));
            }

            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bukti'), $filename);
            $validated['bukti_pembayaran'] = 'uploads/bukti/' . $filename;
        }

        $pembayaran->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pembayaran berhasil diupdate',
            'data' => $pembayaran
        ]);
    }

    public function apiDestroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        if(!$pembayaran){
            return response()->json([
                'status' => 'error',
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        // Hapus foto dari folder saat data dihapus
        if ($pembayaran->bukti_pembayaran && file_exists(public_path($pembayaran->bukti_pembayaran))) {
            unlink(public_path($pembayaran->bukti_pembayaran));
        }

        $pembayaran->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pembayaran berhasil dihapus'
        ]);
    }
}