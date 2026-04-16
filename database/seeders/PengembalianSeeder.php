<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil peminjaman yang statusnya dipinjam
        $peminjamanList = Peminjaman::where('status', 'dipinjam')->get();

        if ($peminjamanList->isEmpty()) {
            $this->command->info('Tidak ada data peminjaman untuk dikembalikan!');
            return;
        }

        foreach ($peminjamanList as $peminjaman) {
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'km_kembali' => $peminjaman->km_berangkat + rand(10, 100),
                'catatan' => 'Kendaraan dikembalikan dalam kondisi baik',
                'waktu_kembali' => now(),
            ]);

            // Update status peminjaman jadi selesai
            $peminjaman->update([
                'status' => 'selesai'
            ]);
        }
    }
}