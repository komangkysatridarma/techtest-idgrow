<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use Illuminate\Http\Request;
use App\Models\ProdukLokasi;
use App\Models\User;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'produk_lokasi_id' => 'required|exists:produk_lokasis,id',
            'user_id' => 'required|exists:users,id',
            'jenis_mutasi' => 'required|in:MASUK,KELUAR',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date|before_or_equal:now',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $produkLokasi = ProdukLokasi::findOrFail($request->produk_lokasi_id);

        if ($request->jenis_mutasi === 'KELUAR') {
            if ($produkLokasi->stok < $request->jumlah) {
                return response()->json([
                    'message' => 'Stok tidak mencukupi untuk melakukan mutasi keluar.'
                ], 422);
            }

            $produkLokasi->stok -= $request->jumlah;
        } elseif ($request->jenis_mutasi === 'MASUK') {
            $produkLokasi->stok += $request->jumlah;
        }

        $produkLokasi->save();

        $mutasi = Mutasi::create([
            'produk_lokasi_id' => $request->produk_lokasi_id,
            'user_id' => $request->user_id,
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'message' => 'Mutasi berhasil disimpan.',
            'data' => $mutasi
        ], 201);
    }

    public function historyByProduk($id)
    {
        $mutasi = Mutasi::whereHas('produkLokasi', function ($query) use ($id) {
            $query->where('produk_id', $id);
        })
        ->with(['produkLokasi.lokasi', 'user'])
        ->orderBy('tanggal', 'desc')
        ->get();

        return response()->json($mutasi);
    }

    public function historyByUser($id)
    {
        $mutasi = Mutasi::where('user_id', $id)
            ->with(['produkLokasi.produk', 'produkLokasi.lokasi'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json($mutasi);
    }

    public function storeByStaff(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'Staff') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'produk_lokasi_id' => 'required|exists:produk_lokasis,id',
            'jenis_mutasi' => 'required|in:MASUK,KELUAR',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date|before_or_equal:now',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $produkLokasi = ProdukLokasi::with('lokasi')->findOrFail($request->produk_lokasi_id);

        $staffLokasiIds = $user->lokasi->pluck('id')->toArray();

        if (!in_array($produkLokasi->lokasi_id, $staffLokasiIds)) {
            return response()->json(['message' => 'Kamu tidak memiliki akses ke lokasi ini.'], 403);
        }

        if ($request->jenis_mutasi === 'KELUAR' && $produkLokasi->stok < $request->jumlah) {
            return response()->json(['message' => 'Stok tidak mencukupi untuk mutasi keluar.'], 422);
        }

        $produkLokasi->stok += ($request->jenis_mutasi === 'MASUK') ? $request->jumlah : -$request->jumlah;
        $produkLokasi->save();

        $mutasi = Mutasi::create([
            'produk_lokasi_id' => $request->produk_lokasi_id,
            'user_id' => $user->id,
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'message' => 'Mutasi berhasil disimpan.',
            'data' => $mutasi
        ], 201);
    }

    public function indexByStaff(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'Staff') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $staffLokasiIds = $user->lokasi->pluck('id')->toArray();

        $mutasi = Mutasi::whereHas('produkLokasi', function ($query) use ($staffLokasiIds) {
                $query->whereIn('lokasi_id', $staffLokasiIds);
            })
            ->with(['produkLokasi.produk', 'produkLokasi.lokasi'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $mutasi
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mutasi $mutasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mutasi $mutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        //
    }

    /**
 * Remove the specified resource from storage.
 */
    public function destroy(Mutasi $mutasi)
    {
        $produkLokasi = $mutasi->produkLokasi;

        if ($mutasi->jenis_mutasi === 'MASUK') {
            if ($produkLokasi->stok < $mutasi->jumlah) {
                return response()->json([
                    'message' => 'Stok tidak mencukupi untuk menghapus mutasi MASUK.'
                ], 422);
            }
            $produkLokasi->stok -= $mutasi->jumlah;
        } elseif ($mutasi->jenis_mutasi === 'KELUAR') {
            $produkLokasi->stok += $mutasi->jumlah;
        }

        $produkLokasi->save();

        $mutasi->delete();

        return response()->json([
            'message' => 'Mutasi berhasil dihapus.'
        ]);
    }
}
