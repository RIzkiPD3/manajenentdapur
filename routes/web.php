<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    MenuController,
    KelompokPiketController,
    JadwalPiketController,
    SesiAbsensiController,
    AbsensiPetugasController,
    RequestNampanController,
    AdminDashboardController,
    AngkatanController
};
use App\Http\Middleware\{
    RoleRedirect,
    AdminMiddleware,
    PetugasMiddleware,
    AngkatanMiddleware
};

// Halaman awal (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route register
Route::get('/register', [AngkatanController::class, 'create'])->name('register');
Route::post('/register', [AngkatanController::class, 'store'])->name('register.store');

// Role redirect
Route::middleware(['auth', RoleRedirect::class])->get('/dashboard', fn() => null)->name('dashboard');

// ================= ADMIN ===================
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Management Angkatan
        Route::resource('angkatan', AngkatanController::class)->except(['show']);
        Route::resource('menus', MenuController::class);
        Route::resource('kelompok', KelompokPiketController::class)->except(['show']);
        Route::resource('jadwal', JadwalPiketController::class)->except(['show']);
        Route::resource('sesi-absensi', SesiAbsensiController::class)->except(['show']);

        // Admin dapat melihat semua request nampan
        Route::get('/request-nampan', [RequestNampanController::class, 'index'])->name('request-nampan');
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat-request');
        Route::delete('/request-nampan/{id}', [RequestNampanController::class, 'destroy'])->name('request-nampan.destroy');
    });

// ================= PETUGAS ===================
Route::middleware(['auth', PetugasMiddleware::class])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('petugas.dashboard'))->name('dashboard');
        Route::get('/jadwal', [JadwalPiketController::class, 'jadwalPetugas'])->name('jadwal');

        // ABSENSI ROUTES
        Route::get('/absensi', [AbsensiPetugasController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/report', [AbsensiPetugasController::class, 'report'])->name('absensi.report');
        Route::get('/absensi/{tanggal}', [AbsensiPetugasController::class, 'show'])->name('absensi.show');
        Route::post('/absensi/{tanggal}', [AbsensiPetugasController::class, 'store'])->name('absensi.store');
        Route::post('/absensi/{tanggal}/bulk', [AbsensiPetugasController::class, 'bulkStore'])->name('absensi.bulk-store');

        Route::resource('kelompok', KelompokPiketController::class)->except(['show']);

        // Petugas mengelola request nampan
        Route::get('/request-nampan', [RequestNampanController::class, 'index'])->name('request-nampan');
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat-request');
        Route::delete('/request-nampan/{id}', [RequestNampanController::class, 'destroy'])->name('request-nampan.destroy');

        // Route untuk nampan
        Route::get('/nampan', [RequestNampanController::class, 'index'])->name('nampan.index');
        Route::get('/nampan/riwayat', [RequestNampanController::class, 'riwayatSemua'])->name('nampan.riwayat');
        Route::delete('/nampan/{id}', [RequestNampanController::class, 'destroy'])->name('nampan.destroy');
    });

// ================= ANGKATAN ===================
Route::middleware(['auth', AngkatanMiddleware::class])
    ->prefix('angkatan')
    ->name('angkatan.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('angkatan.dashboard'))->name('dashboard');

        // Routes untuk request nampan - DIPERBAIKI
        Route::get('/request-nampan/create', [RequestNampanController::class, 'create'])->name('request-nampan.create');
        Route::get('/request-nampan', [RequestNampanController::class, 'create'])->name('request-nampan.index');
        Route::post('/request-nampan', [RequestNampanController::class, 'store'])->name('request-nampan.store');

        // Routes untuk riwayat request
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSaya'])->name('riwayat-request');
        Route::delete('/riwayat-request/{id}', [RequestNampanController::class, 'destroy'])->name('riwayat-request.destroy');
    });