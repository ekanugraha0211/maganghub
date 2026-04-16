<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perawatan;
use App\Models\Kendaraan;

class PerawatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil nama kendaraan (opsional biar realistis)
        // $kendaraans = Kendaraan::pluck('nama_');

        $data = [
            [
                'nama_kendaraan' => 'Toyota Avanza',
                'pemeriksa' => 'Bengkel Jaya Motor',
                'jenis_perawatan' => 'Service Berkala',
                'waktu_perawatan' => now()->subDays(10),
                'biaya' => 500000,
                'catatan' => 'Ganti oli dan cek mesin',
            ],
            [
                'nama_kendaraan' => 'Honda Beat',
                'pemeriksa' => 'AHASS Resmi',
                'jenis_perawatan' => 'Tune Up',
                'waktu_perawatan' => now()->subDays(5),
                'biaya' => 250000,
                'catatan' => 'Servis ringan',
            ],
            [
                'nama_kendaraan' => 'Suzuki Ertiga',
                'pemeriksa' => 'Bengkel Mandiri',
                'jenis_perawatan' => 'Perbaikan',
                'waktu_perawatan' => now()->subDays(2),
                'biaya' => 750000,
                'catatan' => 'Ganti kampas rem',
            ],
        ];

        foreach ($data as $item) {
            Perawatan::create($item);
        }
    }
}