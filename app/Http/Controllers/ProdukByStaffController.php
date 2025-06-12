<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukLokasi;
use Illuminate\Support\Facades\Auth;

class ProdukByStaffController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'Staff') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $lokasiIds = $user->lokasi->pluck('id');

        $produkLokasi = ProdukLokasi::with('produk', 'lokasi')
            ->whereIn('lokasi_id', $lokasiIds)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $produkLokasi
        ]);
    }
}
