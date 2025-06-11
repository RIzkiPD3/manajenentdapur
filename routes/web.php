<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    MenuController,
    KelompokPiketController,
    JadwalPiketController,
    SesiAbsensiController,
    AbsensiPetugasController,
    RequestNampanController
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

// Role redirect (auth + role redirect middleware)
Route::middleware(['auth', RoleRedirect::class])->get('/dashboard', fn() => null);

// ================= ADMIN ===================
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::resource('menus', MenuController::class)->except(['show']);
        Route::resource('kelompok', KelompokPiketController::class)->except(['show']);
        Route::resource('jadwal', JadwalPiketController::class)->except(['show']);
        Route::resource('sesi-absensi', SesiAbsensiController::class)->except(['show']);

        // Admin dapat melihat semua request nampan
        Route::get('/request-nampan', [RequestNampanController::class, 'index'])->name('request-nampan');
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat-request');
        Route::patch('/request-nampan/{id}/status', [RequestNampanController::class, 'updateStatus'])->name('request-nampan.update-status');
        Route::delete('/request-nampan/{id}', [RequestNampanController::class, 'destroy'])->name('request-nampan.destroy');
    });

// ================= PETUGAS ===================
Route::middleware(['auth', PetugasMiddleware::class])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('petugas.dashboard'))->name('dashboard');
        Route::get('/jadwal', [JadwalPiketController::class, 'jadwalPetugas'])->name('jadwal');
        Route::get('/absensi', [AbsensiPetugasController::class, 'index'])->name('absensi.index');
        Route::post('/absensi/{sesi}', [AbsensiPetugasController::class, 'store'])->name('absensi.store');

        // Petugas mengelola request nampan
        Route::get('/request-nampan', [RequestNampanController::class, 'index'])->name('request-nampan');
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat-request');
        Route::patch('/request-nampan/{id}/status', [RequestNampanController::class, 'updateStatus'])->name('request-nampan.update-status');
        Route::delete('/request-nampan/{id}', [RequestNampanController::class, 'destroy'])->name('request-nampan.destroy');
    });

// ================= ANGKATAN ===================
Route::middleware(['auth', AngkatanMiddleware::class])
    ->prefix('angkatan')
    ->name('angkatan.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('angkatan.dashboard'))->name('dashboard');

        // PERBAIKAN UTAMA - Semua kemungkinan nama route
        Route::get('/request-nampan', [RequestNampanController::class, 'create'])->name('request-nampan');
        Route::post('/request-nampan', [RequestNampanController::class, 'store'])->name('request-nampan.store');

        // Alias untuk backward compatibility
        Route::get('/request-nampan-create', [RequestNampanController::class, 'create'])->name('request-nampan.create');

        // Routes untuk riwayat request
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSaya'])->name('riwayat-request');
        Route::delete('/riwayat-request/{id}', [RequestNampanController::class, 'destroy'])->name('riwayat-request.destroy');
    });