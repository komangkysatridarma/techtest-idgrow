<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Staff Bogor',
            'email' => 'staff@example.com',
            'password' => Hash::make('staff123'),
            'role' => 'Staff',
            'no_hp' => '081234567890',
        ]);

        User::create([
            'nama' => 'Admin Jakarta',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'no_hp' => '081298765432',
        ]);
    }
}
