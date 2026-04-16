<?php 

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $data = Kendaraan::all();
        return view('kendaraan.index', compact('data'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    // public function store(Request $request)
    // {
    //     Kendaraan::create($request->all());
    //     return redirect()->route('kendaraan.index')->with('success', 'Data berhasil ditambahkan');
    // }
    public function store(Request $request)
{
    $data = $request->validate([
        'nama' => 'required',
        'plat_nomor' => 'required',
        'merek' => 'required',
        'warna' => 'required',
        'tahun' => 'required',
        'jenis_bbm' => 'required',
        'ketersediaan' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $namaFile = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('images'), $namaFile);

        $data['foto'] = $namaFile;
    }

    Kendaraan::create($data);

    return redirect()->route('kendaraan.index')
        ->with('success', 'Data berhasil ditambahkan');
}

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }


    public function update(Request $request, Kendaraan $kendaraan)
{
    $data = $request->validate([
        'nama' => 'required',
        'plat_nomor' => 'required',
        'merek' => 'required',
        'warna' => 'required',
        'tahun' => 'required',
        'jenis_bbm' => 'required',
        'ketersediaan' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $namaFile = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('images'), $namaFile);

        $data['foto'] = $namaFile;
    }

    $kendaraan->update($data);

    return redirect()->route('kendaraan.index')
        ->with('success', 'Data berhasil diupdate');
}

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus');
    }
}