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

    // Batasi akses hanya untuk staff
    if ($user->role !== 'Staff') {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    // Ambil ID lokasi yang dimiliki staff dari relasi many-to-many
    $lokasiIds = $user->lokasi->pluck('id');

    // Ambil data produk_lokasis yang hanya berada di lokasi staff tersebut
    $produkLokasi = ProdukLokasi::with('produk', 'lokasi')
        ->whereIn('lokasi_id', $lokasiIds)
        ->get();

    // Return data dalam bentuk JSON
    return response()->json([
        'status' => 'success',
        'data' => $produkLokasi
    ]);
}
}
