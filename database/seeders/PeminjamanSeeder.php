<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Kendaraan;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kendaraan
        $kendaraans = Kendaraan::all();

        // Jika belum ada kendaraan, hentikan
        if ($kendaraans->isEmpty()) {
            $this->command->info('Data kendaraan kosong, jalankan KendaraanSeeder dulu!');
            return;
        }

        $data = [
            [
                'nama_peminjam' => 'Budi Santoso',
                'kendaraan_id' => $kendaraans->random()->id,
                'tujuan' => 'Surabaya',
                'keperluan' => 'Dinas luar',
                'km_berangkat' => 12000,
                'waktu_pinjam' => now()->subDays(2),
                // 'kondisi_kendaraan' => 'Baik',
                'status' => 'dipinjam',
            ],
            [
                'nama_peminjam' => 'Siti Aminah',
                'kendaraan_id' => $kendaraans->random()->id,
                'tujuan' => 'Malang',
                'keperluan' => 'Kunjungan kerja',
                'km_berangkat' => 8000,
                'waktu_pinjam' => now()->subDay(),
                // 'kondisi_kendaraan' => 'Baik',
                'status' => 'dipinjam',
            ],
            [
                'nama_peminjam' => 'Andi Wijaya',
                'kendaraan_id' => $kendaraans->random()->id,
                'tujuan' => 'Sidoarjo',
                'keperluan' => 'Meeting',
                'km_berangkat' => 15000,
                'waktu_pinjam' => now(),
                // 'kondisi_kendaraan' => 'Baik',
                'status' => 'dipinjam',
            ],
        ];

        foreach ($data as $item) {
            Peminjaman::create($item);
        }
    }
}