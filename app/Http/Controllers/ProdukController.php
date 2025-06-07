<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Produk::with(['kategori', 'satuan'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string',
            'harga' => 'required|integer',
            'kode_produk' => 'required|string|unique:produks',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
            'deskripsi' => 'nullable|string',
        ]);

        $produk = Produk::create($validated);
        return response()->json($produk, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Produk::with(['kategori', 'satuan'])->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string',
            'harga' => 'required|integer',
            'kode_produk' => 'required|string|unique:produks,kode_produk,' . $id,
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
            'deskripsi' => 'nullable|string',
        ]);

        $produk->update($validated);
        return response()->json($produk);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json(['message' => 'Produk deleted']);
    }
}
