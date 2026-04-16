<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    protected $table = 'perawatan';

    protected $fillable = [
        'nama_kendaraan',
        'pemeriksa',
        'jenis_perawatan',
        'waktu_perawatan',
        'biaya',
        'catatan',
    ];
}