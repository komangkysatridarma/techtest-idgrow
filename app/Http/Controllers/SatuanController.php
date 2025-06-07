<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Satuan::all());
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
            'nama_satuan' => 'required|string|max:255',
            'kategori_satuan' => 'required|string|max:255'
        ]);

        $satuan = Satuan::create($validated);

        return response()->json($satuan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $satuan = Satuan::findOrFail($id);
        return response()->json($satuan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $satuan = Satuan::findOrFail($id);

        $validated = $request->validate([
            'nama_satuan' => 'required|string|max:255',
            'kategori_satuan' => 'required|string|max:255'
        ]);

        $satuan->update($validated);

        return response()->json($satuan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->delete();

        return response()->json(['message' => 'Satuan deleted']);
    }
}
