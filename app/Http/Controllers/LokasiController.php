<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        return response()->json(Lokasi::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_lokasi' => 'required|string|max:255',
            'nama_lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500'
        ]);

        $lokasi = Lokasi::create($validated);
        return response()->json($lokasi, 201);
    }

    public function show($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        return response()->json($lokasi);
    }

    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $validated = $request->validate([
             'kode_lokasi' => 'required|string|max:255',
            'nama_lokasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500'
        ]);

        $lokasi->update($validated);
        return response()->json($lokasi);
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return response()->json(['message' => 'Lokasi deleted']);
    }
}
