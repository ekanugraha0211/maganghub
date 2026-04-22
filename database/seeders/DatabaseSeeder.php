<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan pengguna admin
        User::create([
            'name' => 'Simopas',
            'email' => 'info@lapaspasuruan.id',
            'password' => ('lapaspasuruan'),
            'role' => 'admin'
        ]);

        // Tambahkan pengguna operator
        // Jika ada seeders lain, panggil di sini
        // $this->call(SeederLain::class);
        $this->call([
        KendaraanSeeder::class,
        PeminjamanSeeder::class,
        PengembalianSeeder::class,
        PerawatanSeeder::class
    ]);
    }
}
