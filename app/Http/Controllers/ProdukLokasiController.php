<?php

namespace App\Http\Controllers;

use App\Models\ProdukLokasi;
use Illuminate\Http\Request;

class ProdukLokasiController extends Controller
{
    public function index()
    {
        return response()->json(ProdukLokasi::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'stok' => 'required|integer|min:0',
        ]);

        $existing = ProdukLokasi::where('produk_id', $validated['produk_id'])
            ->where('lokasi_id', $validated['lokasi_id'])
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Produk sudah terdaftar di lokasi ini.'
            ], 409);
        }

        $produkLokasi = ProdukLokasi::create($validated);
        return response()->json($produkLokasi, 201);
    }

    public function show($id)
    {
        $produkLokasi = ProdukLokasi::findOrFail($id);
        return response()->json($produkLokasi);
    }

    public function update(Request $request, $id)
    {
        $produkLokasi = ProdukLokasi::findOrFail($id);

        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'stok' => 'required|integer|min:0',
        ]);

        $duplicate = ProdukLokasi::where('produk_id', $validated['produk_id'])
            ->where('lokasi_id', $validated['lokasi_id'])
            ->where('id', '!=', $id)
            ->first();

        if ($duplicate) {
            return response()->json([
                'message' => 'Kombinasi produk dan lokasi sudah digunakan pada entri lain.'
            ], 409);
        }

        $produkLokasi->update($validated);
        return response()->json($produkLokasi);
    }

    public function destroy($id)
    {
        $produkLokasi = ProdukLokasi::findOrFail($id);
        $produkLokasi->delete();

        return response()->json(['message' => 'Produk lokasi deleted']);
    }
}
