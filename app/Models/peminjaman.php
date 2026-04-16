<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamen';

    protected $fillable = [
        'nama_peminjam',
        'kendaraan_id',
        'tujuan',
        'keperluan',
        'km_berangkat',
        'waktu_pinjam',
        // 'kondisi_kendaraan',
        'status',
    ];

    // Relasi ke kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // Relasi ke pengembalian (1 peminjaman = 1 pengembalian)
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}