<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffLokasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lokasi_id' => 'required|exists:lokasis,id',
        ]);

        $user = User::findOrFail($request->user_id);
        if ($user->role !== 'Staff') {
            return response()->json(['message' => 'User bukan staff'], 422);
        }

        $user->lokasi()->syncWithoutDetaching([$request->lokasi_id]);

        return response()->json(['message' => 'Staff berhasil ditambahkan ke lokasi']);
    }

    public function getStaffByLokasi($lokasiId)
    {
        $lokasi = Lokasi::with('staff')->findOrFail($lokasiId);
        return response()->json([
            'lokasi' => $lokasi->nama_lokasi,
            'staff' => $lokasi->staff,
        ]);
    }
}
