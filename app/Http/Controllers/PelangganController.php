<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan; // Pastikan model Pelanggan sudah dibuat
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        return view('pelanggan');
    }

    public function apiIndex()
    {
        $pelanggan = Pelanggan::latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $pelanggan
        ]);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'status' => 'required'
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pelanggan berhasil ditambahkan',
            'data' => $pelanggan
        ]);
    }

    public function apiUpdate(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if(!$pelanggan){
            return response()->json([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'status' => 'required'
        ]);

        $pelanggan->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pelanggan berhasil diupdate',
            'data' => $pelanggan
        ]);
    }

    public function apiDestroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        if(!$pelanggan){
            return response()->json([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        $pelanggan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pelanggan berhasil dihapus'
        ]);
    }
}