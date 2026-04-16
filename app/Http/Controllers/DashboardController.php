<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Perawatan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔹 Total kendaraan
        $totalKendaraan = Kendaraan::count();

        // 🔹 Kendaraan sedang dipinjam
        $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // 🔹 Total pengembalian
        $totalPengembalian = Pengembalian::count();

        // 🔹 Perawatan dalam 30 hari terakhir
        $perawatanTerbaru = Perawatan::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // 🔹 Kendaraan yang belum kembali (telat bisa dikembangkan nanti)
        $belumKembali = Peminjaman::where('status', 'dipinjam')->count();

        return view('dashboard', compact(
            'totalKendaraan',
            'totalDipinjam',
            'totalPengembalian',
            'perawatanTerbaru',
            'belumKembali'
        ));
    }
}

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         // Menghitung total barang
//         $totalBarangs = Barang::count();

//         // Menghitung total petugas dengan role 'operator' atau 'admin'
//         $totalPetugas = User::where('role', 'operator')->orWhere('role', 'admin')->count();

//         // Menghitung total barang yang sedang dipinjam
//         $totalBorrowedItems = Borrow::where('status', 'Sedang Dipinjam')->count();

//         // Menghitung petugas baru yang ditambahkan dalam 30 hari terakhir
//         $recentPetugas = User::where('role', 'operator')
//                              ->orWhere('role', 'admin')
//                              ->where('created_at', '>=', Carbon::now()->subDays(30))
//                              ->count();

//         // Menghitung jumlah barang yang pengembaliannya tertunda
//         $pendingReturns = Borrow::where('status', 'Tertunda')
//                                 ->count();

//         return view('dashboard', compact('totalBarangs', 'totalPetugas', 'totalBorrowedItems', 'recentPetugas', 'pendingReturns'));
//     }
// }
