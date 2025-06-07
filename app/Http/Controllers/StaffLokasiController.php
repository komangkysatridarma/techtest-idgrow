<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffLokasiController extends Controller
{
    // Assign staff ke lokasi
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lokasi_id' => 'required|exists:lokasis,id',
        ]);

        // Cek apakah user adalah staff
        $user = User::findOrFail($request->user_id);
        if ($user->role !== 'Staff') {
            return response()->json(['message' => 'User bukan staff'], 422);
        }

        // Assign ke pivot table
        $user->lokasi()->syncWithoutDetaching([$request->lokasi_id]);

        return response()->json(['message' => 'Staff berhasil ditambahkan ke lokasi']);
    }

    // Lihat semua staff untuk lokasi tertentu
    public function getStaffByLokasi($lokasiId)
    {
        $lokasi = Lokasi::with('staff')->findOrFail($lokasiId);
        return response()->json([
            'lokasi' => $lokasi->nama_lokasi,
            'staff' => $lokasi->staff,
        ]);
    }
}
