<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Perawatan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GuestDashboardController extends Controller
{
    // public function index()
    // {
    //     // $data = Kendaraan::all();
    //     $data = Kendaraan::with('peminjamanTerakhir')->where('ketersediaan', 'tersedia')->get();

    //     return view('guest.dashboard', compact('data'));
    // }
    public function index()
{
    $data = Kendaraan::with('peminjamanTerakhir')
        ->where('ketersediaan', 'tersedia')
        ->get();

    return view('guest.dashboard', compact('data'));
}
    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $peminjaman = Peminjaman::where('kendaraan_id', $kendaraan->id)
        ->latest()
        ->first();

        return view('guest.show', compact(['kendaraan','peminjaman']));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'kendaraan_id'  => 'required|exists:kendaraan,id',
            'tujuan'        => 'required|string|max:255',
            'keperluan'     => 'required|string',
            'km_berangkat'  => 'required|numeric|min:0',
            'waktu_pinjam'  => 'required|date',
        ]);

        $peminjaman = Peminjaman::create([
            'nama_peminjam' => $data['nama_peminjam'],
            'kendaraan_id'  => $data['kendaraan_id'],
            'tujuan'        => $data['tujuan'],
            'keperluan'     => $data['keperluan'],
            'km_berangkat'  => $data['km_berangkat'],
            'waktu_pinjam'  => $data['waktu_pinjam'],
            'status'        => 'dipinjam',
        ]);

        return redirect()
            ->route('guest.show', $data['kendaraan_id'])
            ->with('success', 'Kendaraan berhasil dipinjam.');
    }
    public function pengembalian(Request $request)
    {
        $data = $request->validate([
            'peminjaman_id'  => 'required|exists:peminjamen,id',
            'km_kembali'     => 'required|numeric|min:0',
            'catatan'        => 'nullable|string',
            'waktu_kembali'  => 'required|date',
        ]);

        Pengembalian::create($data);
        $peminjaman = Peminjaman::findOrFail($data['peminjaman_id']);

        $peminjaman->status = 'selesai';
        $peminjaman->save();

                
            return redirect()->back()
                ->with('success', 'Data pengembalian berhasil ditambahkan');
        }
            
        }

