<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengelolaGudangController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthenticatePengelola;
use App\Http\Middleware\GuestPengelola;

// Rute publik
Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Rute untuk tamu (belum login)
Route::middleware([GuestPengelola::class])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rute yang memerlukan autentikasi
Route::middleware([AuthenticatePengelola::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Inventory routes
    Route::resource('inventory', InventoryController::class);
    Route::get('/inventory/laporan', [InventoryController::class, 'laporan'])->name('inventory.laporan');

    // Laporan routes
    Route::resource('laporan', LaporanController::class);

    // Log Aktivitas routes
    Route::resource('log_aktivitas', LogAktivitasController::class)->only(['index', 'show']);

    // Pengelola Gudang management routes
    Route::resource('pengelola_gudang', PengelolaGudangController::class);

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Menghapus rute duplikat dan mengorganisir rute yang tersisa
Route::prefix('laporan')->middleware([AuthenticatePengelola::class])->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/', [LaporanController::class, 'store'])->name('laporan.store');
    Route::put('/{id}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::get('/{id}', [LaporanController::class, 'show'])->name('laporan.show');
});
