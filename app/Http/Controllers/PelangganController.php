<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan halaman daftar pelanggan B2B
     */
    public function index()
    {
        // Langsung manggil file view pelanggan.blade.php
        return view('pelanggan');
    }
}