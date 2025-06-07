<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama_produk' => 'Sabun Mandi',
            'harga' => 12000,
            'kode_produk' => 'PRD00001',
            'kategori_id' => 1,
            'satuan_id' => 1,
            'deskripsi' => 'Sabun mandi wangi',
        ]);
    }
}
