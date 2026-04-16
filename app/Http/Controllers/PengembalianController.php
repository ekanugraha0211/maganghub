<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
    $peminjaman = Peminjaman::all();    
    $data = Pengembalian::with('peminjaman.kendaraan')->latest()->get();
        return view('pengembalian.index', compact('data','peminjaman'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::where('status', 'dipinjam')->get();
        return view('pengembalian.create', compact('peminjaman'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'peminjaman_id'  => 'required|exists:peminjamen,id',
            'km_kembali'     => 'required|numeric|min:0',
            'catatan'        => 'nullable|string',
            'waktu_kembali'  => 'required|date',
        ]);

        Pengembalian::create($data);

        // ubah status peminjaman menjadi selesai
        $peminjaman = Peminjaman::findOrFail($data['peminjaman_id']);
        $peminjaman->update([
            'status' => 'selesai'
        ]);

        return redirect()->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil ditambahkan');
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'peminjaman_id'  => 'required|exists:peminjamen,id',
            'km_kembali'     => 'required|numeric|min:0',
            'catatan'        => 'nullable|string',
            'waktu_kembali'  => 'required|date',
        ]);

        $peminjaman->update([
            'status' => 'selesai'
        ]);

        Pengembalian::where('peminjaman_id', $data['peminjaman_id'])->update([
            'km_kembali'    => $data['km_kembali'],
            'catatan'       => $data['catatan'],
            'waktu_kembali' => $data['waktu_kembali'],
        ]);

        return redirect()->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil diupdate');
    }
public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        return redirect()->route('pengembalian.index');
    }
    
}
