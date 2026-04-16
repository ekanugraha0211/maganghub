<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Avanza',
                'plat_nomor' => 'L 1234 AB',
                'merek' => 'Toyota',
                'warna' => 'Hitam',
                'tahun' => 2020,
                'jenis_bbm' => 'Bensin',
                'ketersediaan' => 'tersedia',
            ],
            [
                'nama' => 'Beat',
                'plat_nomor' => 'L 5678 CD',
                'merek' => 'Honda',
                'warna' => 'Putih',
                'tahun' => 2022,
                'jenis_bbm' => 'Bensin',
                'ketersediaan' => 'tersedia',
            ],
            [
                'nama' => 'Ertiga',
                'plat_nomor' => 'L 9012 EF',
                'merek' => 'Suzuki',
                'warna' => 'Abu-abu',
                'tahun' => 2019,
                'jenis_bbm' => 'Bensin',
                'ketersediaan' => 'tersedia',
            ],
        ];

        foreach ($data as $item) {
            Kendaraan::create($item);
        }
    }
}