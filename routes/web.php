<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller Lama (dipakai)
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestDashboardController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\RecapController;

// Controller CRUD
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\PetugasController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']) ;
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| REDIRECT ROLE
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    if (Auth::user()->role == 'admin') {
        return redirect('/admin/dashboard');
    } elseif (Auth::user()->role == 'operator') {
        return redirect('/scan');
    }
    return redirect('/');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/admin', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('/', [GuestDashboardController::class, 'index']);
Route::get('/', [GuestDashboardController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| MAIN SYSTEM (BORROW FLOW - TIDAK DIUBAH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Scan & Borrow
    Route::get('/scan', [BorrowController::class, 'showBorrowForm'])->name('scan');
    Route::get('/items', [BorrowController::class, 'showItems'])->name('items.show');

    Route::post('/scan-barcode', [BorrowController::class, 'scanBarcode'])->name('scanBarcode');

    Route::post('/add-to-cart', [BorrowController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/get-cart', [BorrowController::class, 'getCart'])->name('get.cart');
    Route::post('/remove-from-cart', [BorrowController::class, 'removeFromCart'])->name('remove.from.cart');

    Route::post('/process-borrow', [BorrowController::class, 'processBorrow'])->name('process.borrow');

    // Pengembalian via flow lama
    Route::post('/return/{id}', [BorrowController::class, 'updateReturnDate'])->name('update.return');
    Route::post('/borrow/{id}/complete', [BorrowController::class, 'completeBorrow'])->name('complete.borrow');

    // Recap
    Route::get('/recap', [RecapController::class, 'index'])->name('recap');
    Route::get('/borrow/{borrow_id}/detail', [RecapController::class, 'showDetail'])->name('borrow.detail');

});

/*
|--------------------------------------------------------------------------
| CRUD TAMBAHAN (FITUR BARU)
|--------------------------------------------------------------------------
*/

// Kendaraan (pengganti barang)
Route::resource('kendaraan', KendaraanController::class)->middleware('auth');

// Peminjaman manual (opsional)
Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');

// Pengembalian manual
Route::resource('pengembalian', PengembalianController::class)->middleware('auth');

// Perawatan
Route::resource('perawatan', PerawatanController::class)->middleware('auth');

// Petugas tetap
Route::resource('petugas', PetugasController::class)->middleware('auth');

// Dashboard tetap
Route::resource('admin/dashboard', DashboardController::class)->middleware('auth');

Route::resource('guest', GuestDashboardController::class);
Route::post('/guest/pengembalian', [GuestDashboardController::class, 'pengembalian'])
    ->name('guest.kembali');