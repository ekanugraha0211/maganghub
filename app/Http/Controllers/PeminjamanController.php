<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
    $kendaraan = Kendaraan::all();  
    $data = Peminjaman::with('kendaraan')->latest()->get();
        return view('peminjaman.index', compact('data', 'kendaraan'));
    }

    public function create()
    {
        $kendaraan = Kendaraan::where('status', 'tersedia')->get();
        return view('peminjaman.create', compact('kendaraan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_peminjam'      => 'required|string|max:255',
            'kendaraan_id'       => 'required|exists:kendaraan,id',
            'tujuan'             => 'required|string|max:255',
            'keperluan'          => 'required|string',
            'km_berangkat'       => 'required|numeric|min:0',
            'waktu_pinjam'       => 'required|date',
            'kondisi_kendaraan'  => 'required|string',
            'status'             => 'required|in:dipinjam,selesai,dibatalkan',
        ]);

        Peminjaman::create($data);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'nama_peminjam'     => 'required|string|max:255',
            'kendaraan_id'      => 'required|exists:kendaraan,id',
            'tujuan'            => 'required|string|max:255',
            'keperluan'         => 'required|string',
            'km_berangkat'      => 'required|numeric|min:0',
            'waktu_pinjam'      => 'required|date',
            'kondisi_kendaraan' => 'required|string',
            'status'            => 'required|in:dipinjam,selesai,dibatalkan',
        ]);

        $peminjaman->update($data);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diupdate');
    }
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index');
    }
}
