<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        Lokasi::create([
            'kode_lokasi' => 'LKS001',
            'nama_lokasi' => 'Gudang Besar',
            'keterangan' => 'Gudang pusat distribusi',
            'alamat' => 'Jl. Industri No. 100',
        ]);
    }
}
