<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // INI YANG HILANG TADI! Fungsi buat nampilin UI HTML
    public function index()
    {
        return view('produk'); 
    }

    public function apiIndex()
    {
        $products = Product::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0'
        ]);

        $product = Product::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ]);
    }

    public function apiShow($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ],404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    public function apiUpdate(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ],404);
        }

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0'
        ]);

        $product->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diupdate',
            'data' => $product
        ]);
    }

    public function apiDestroy($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ],404);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}