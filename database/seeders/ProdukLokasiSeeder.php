<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukLokasi;

class ProdukLokasiSeeder extends Seeder
{
    public function run(): void
    {
        ProdukLokasi::create([
            'produk_id' => 1,
            'lokasi_id' => 1,
            'stok' => 100,
        ]);
    }
}
