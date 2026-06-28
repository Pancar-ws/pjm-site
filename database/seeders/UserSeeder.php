<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Admin Gudang
        User::create([
            'name' => 'Admin Gudang Utama',
            'email' => 'admin@snackdist.com',
            'password' => Hash::make('password123'), // Sesuai aturan ujian min 8 karakter
            'role' => 'admin',
        ]);

        // Membuat Agen Ritel
        User::create([
            'name' => 'Agen Ritel Makmur',
            'email' => 'agen@snackdist.com',
            'password' => Hash::make('password123'),
            'role' => 'agen',
        ]);
    }
}