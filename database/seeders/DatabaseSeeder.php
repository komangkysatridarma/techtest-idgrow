<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SatuanSeeder::class,
            KategoriSeeder::class,
            ProdukSeeder::class,
            LokasiSeeder::class,
            ProdukLokasiSeeder::class,
            MutasiSeeder::class,
        ]);
    }
}
