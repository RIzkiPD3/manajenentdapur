<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    AdminDashboardController,
    MenuController,
    KelompokPiketController,
    JadwalPiketController,
    SesiAbsensiController,
    AbsensiPetugasController,
    RequestNampanController,
    AngkatanController
};

use App\Http\Middleware\{
    RoleRedirect,
    AdminMiddleware,
    PetugasMiddleware,
    AngkatanMiddleware
};

// ============================
// 🔓 Halaman Awal & Auth
// ============================
Route::get('/', function() {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Pendaftaran Akun Angkatan (oleh Admin / terbuka)
Route::get('/register', [AngkatanController::class, 'create'])->name('register');
Route::post('/register', [AngkatanController::class, 'store'])->name('register.store');

// Setelah login, redirect ke dashboard sesuai role
Route::middleware(['auth', RoleRedirect::class])
    ->get('/dashboard', function() {
        return redirect()->route('dashboard');
    })
    ->name('dashboard');

// ============================
// 👤 ADMIN ROUTES
// ============================
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Data
        Route::resource('menus', MenuController::class);
        Route::resource('kelompok', KelompokPiketController::class)->except(['show']);
        Route::resource('sesi-absensi', SesiAbsensiController::class)->except(['show']);
        Route::resource('angkatan', AngkatanController::class)->except(['show']);

        // ✅ PERBAIKAN LENGKAP: Jadwal Piket Routes
        Route::resource('jadwal', JadwalPiketController::class)->except(['show']);

        // Generate Rolling Jadwal Routes - DIPERBAIKI
        Route::get('/jadwal/generate', [JadwalPiketController::class, 'generateForm'])->name('jadwal.generate');
        Route::post('/jadwal/generate', [JadwalPiketController::class, 'generateRolling'])->name('jadwal.generate.store');

        // Request Nampan
        Route::get('/request-nampan', [RequestNampanController::class, 'index'])->name('request-nampan');
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat-request');
        Route::patch('/request-nampan/{id}/status', [RequestNampanController::class, 'updateStatus'])->name('request-nampan.update-status');
        Route::delete('/request-nampan/{id}', [RequestNampanController::class, 'destroy'])->name('request-nampan.destroy');
    });

// ============================
// 🛠️ PETUGAS ROUTES
// ============================
Route::middleware(['auth', PetugasMiddleware::class])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', function() {
            return view('petugas.dashboard');
        })->name('dashboard');

        Route::get('/jadwal', [JadwalPiketController::class, 'jadwalPetugas'])->name('jadwal');

        // Absensi Petugas
        Route::get('/absensi', [AbsensiPetugasController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/report', [AbsensiPetugasController::class, 'report'])->name('absensi.report');
        Route::get('/absensi/{tanggal}', [AbsensiPetugasController::class, 'show'])->name('absensi.show');
        Route::post('/absensi/{tanggal}', [AbsensiPetugasController::class, 'store'])->name('absensi.store');
        Route::post('/absensi/{tanggal}/bulk', [AbsensiPetugasController::class, 'bulkStore'])->name('absensi.bulk-store');

        // Request Nampan - DIPERBAIKI STRUKTUR ROUTE NYA
        Route::prefix('nampan')->name('nampan.')->group(function () {
            Route::get('/', [RequestNampanController::class, 'index'])->name('index');
            Route::get('/riwayat', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat');
            Route::patch('/{id}/status', [RequestNampanController::class, 'updateStatus'])->name('update-status');
            Route::delete('/{id}', [RequestNampanController::class, 'destroy'])->name('destroy');
        });

        // TAMBAHKAN ROUTE YANG HILANG UNTUK BACKWARD COMPATIBILITY
        Route::get('/request-nampan', [RequestNampanController::class, 'index'])->name('request-nampan');
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat-request');
        Route::patch('/request-nampan/{id}/status', [RequestNampanController::class, 'updateStatus'])->name('request-nampan.update-status');
        Route::delete('/request-nampan/{id}', [RequestNampanController::class, 'destroy'])->name('request-nampan.destroy');
    });

// ============================
// 🎓 ANGKATAN ROUTES
// ============================
Route::middleware(['auth', AngkatanMiddleware::class])
    ->prefix('angkatan')
    ->name('angkatan.')
    ->group(function () {
        Route::get('/dashboard', function() {
            return view('angkatan.dashboard');
        })->name('dashboard');

        // Request Nampan
        Route::get('/request-nampan', [RequestNampanController::class, 'create'])->name('request-nampan');
        Route::post('/request-nampan', [RequestNampanController::class, 'store'])->name('request-nampan.store');
        Route::get('/request-nampan-create', [RequestNampanController::class, 'create'])->name('request-nampan.create');

        // Riwayat Request
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSaya'])->name('riwayat-request');
        Route::delete('/riwayat-request/{id}', [RequestNampanController::class, 'destroy'])->name('riwayat-request.destroy');
    });