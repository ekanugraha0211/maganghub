<?php

namespace App\Http\Controllers;

use App\Models\Perawatan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class PerawatanController extends Controller
{
    public function index()
    {
        $data = Perawatan::all();
        $kendaraan = Kendaraan::all();    

        return view('perawatan.index', compact('data','kendaraan'));
    }

    public function create()
    {
    return view('perawatan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kendaraan'   => 'required|string|max:255',
            'pemeriksa'        => 'required|string|max:255',
            'jenis_perawatan'  => 'required|string|max:255',
            'waktu_perawatan'  => 'required|date',
            'biaya'            => 'required|numeric|min:0',
            'catatan'          => 'nullable|string',
        ]);

        Perawatan::create([
            'nama_kendaraan'  => $data['nama_kendaraan'],
            'pemeriksa'       => $data['pemeriksa'],
            'jenis_perawatan' => $data['jenis_perawatan'],
            'waktu_perawatan' => $data['waktu_perawatan'],
            'biaya'           => $data['biaya'],
            'catatan'         => $data['catatan'],
        ]);

        return redirect()
            ->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil ditambahkan');
    }
    public function edit(Perawatan $perawatan)
    {
        return view('perawatan.edit', compact('perawatan'));
    }

    public function update(Request $request, Perawatan $perawatan)
    {
        $data = $request->validate([
            'nama_kendaraan'   => 'required|string|max:255',
            'pemeriksa'        => 'required|string|max:255',
            'jenis_perawatan'  => 'required|string|max:255',
            'waktu_perawatan'  => 'required|date',
            'biaya'            => 'required|numeric|min:0',
            'catatan'          => 'nullable|string',
        ]);

        $perawatan->update([
            'nama_kendaraan'  => $data['nama_kendaraan'],
            'pemeriksa'       => $data['pemeriksa'],
            'jenis_perawatan' => $data['jenis_perawatan'],
            'waktu_perawatan' => $data['waktu_perawatan'],
            'biaya'           => $data['biaya'],
            'catatan'         => $data['catatan'],
        ]);

        return redirect()
            ->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil diupdate');
    }

    public function destroy(Perawatan $perawatan)
    {
        $perawatan->delete();
        return redirect()->route('perawatan.index');
    }
}