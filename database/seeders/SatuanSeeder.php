<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        Satuan::create([
            'nama_satuan' => 'Dus',
            'kategori_satuan' => 'Kemasan',
        ]);
    }
}
