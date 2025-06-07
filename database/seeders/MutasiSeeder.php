<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mutasi;

class MutasiSeeder extends Seeder
{
    public function run(): void
    {
        Mutasi::create([
            'produk_lokasi_id' => 1,
            'user_id' => 1,
            'jenis_mutasi' => 'MASUK',
            'jumlah' => 20,
            'tanggal' => '2025-06-06 14:30:00',
            'keterangan' => 'Masuk ke sana dengan baik.',
        ]);
    }
}
