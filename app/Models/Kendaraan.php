<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    // Nama tabel yg digunakan model
    protected $table = 'kendaraan';
    // Field yang boleh diisi secara mass assignment.
    protected $fillable = [
        'nama',
        'plat_nomor',
        'merek',
        'warna',
        'tahun',
        'jenis_bbm',
        'foto',
        'ketersediaan',
    ];

    // Relasi: satu kendaraan dapat memiliki banyak data peminjaman.
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Relasi: mengambil data peminjaman terakhir berdasarkan created_at terbaru.
    public function peminjamanTerakhir()
    {
        return $this->hasOne(Peminjaman::class, 'kendaraan_id')
            ->latest('created_at');
    }

}
