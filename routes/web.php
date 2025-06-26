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
    AngkatanController,
    PetugasController
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

        // ✅ PERBAIKAN CRITICAL: Rolling Menu Routes HARUS SEBELUM resource route
        Route::get('/menus/rolling', [MenuController::class, 'rolling'])->name('menus.rolling');
        Route::get('/menus/rolling/generate', [MenuController::class, 'generateRolling'])->name('menus.rolling.generate');
        Route::get('/menus/rolling/preview', [MenuController::class, 'previewRolling'])->name('menus.rolling.preview');
        Route::get('/menus/today', [MenuController::class, 'getTodayMenu'])->name('menus.today');

        // Resource route SETELAH route khusus
        Route::resource('menus', MenuController::class);

        // ✅ PERBAIKAN: Angkatan Routes - Pastikan semua route terdaftar dengan benar
        Route::resource('angkatan', AngkatanController::class);

        // Manajemen Data Lainnya
        Route::resource('kelompok', KelompokPiketController::class)->except(['show']);
        Route::resource('sesi-absensi', SesiAbsensiController::class)->except(['show']);

        // Jadwal Piket Routes - dengan urutan yang benar
        Route::get('/jadwal/generate', [JadwalPiketController::class, 'generateForm'])->name('jadwal.generate');
        Route::post('/jadwal/generate', [JadwalPiketController::class, 'generateRolling'])->name('jadwal.generate.store');
        Route::resource('jadwal', JadwalPiketController::class)->except(['show']);

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
        Route::get('/dashboard', [PetugasController::class, 'index'])->name('dashboard');

        Route::get('/jadwal', [JadwalPiketController::class, 'jadwalPetugas'])->name('jadwal');

        // Absensi Petugas
        Route::get('/absensi', [AbsensiPetugasController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/report', [AbsensiPetugasController::class, 'report'])->name('absensi.report');
        Route::get('/absensi/{tanggal}', [AbsensiPetugasController::class, 'show'])->name('absensi.show');
        Route::post('/absensi/{tanggal}', [AbsensiPetugasController::class, 'store'])->name('absensi.store');
        Route::post('/absensi/{tanggal}/bulk', [AbsensiPetugasController::class, 'bulkStore'])->name('absensi.bulk-store');

        // ✅ PERBAIKAN: Request Nampan - STRUKTUR ROUTE YANG BENAR
        Route::prefix('nampan')->name('nampan.')->group(function () {
            Route::get('/', [RequestNampanController::class, 'index'])->name('index');
            Route::get('/riwayat', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat');
            Route::patch('/{id}/status', [RequestNampanController::class, 'updateStatus'])->name('update-status');
            Route::delete('/{id}', [RequestNampanController::class, 'destroy'])->name('destroy');
        });

        // ✅ BACKWARD COMPATIBILITY: Route lama tetap ada
        Route::get('/request-nampan', [RequestNampanController::class, 'index'])->name('request-nampan');
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSemua'])->name('riwayat-request');
        Route::patch('/request-nampan/{id}/status', [RequestNampanController::class, 'updateStatus'])->name('request-nampan.update-status');
        Route::delete('/request-nampan/{id}', [RequestNampanController::class, 'destroy'])->name('request-nampan.destroy');
    });

// ============================
// 🎓 ANGKATAN ROUTES - SOLUSI LENGKAP
// ============================
Route::middleware(['auth', AngkatanMiddleware::class])
    ->prefix('angkatan')
    ->name('angkatan.')
    ->group(function () {
        Route::get('/dashboard', [AngkatanController::class, 'index'])->name('dashboard');

        // ✅ SOLUSI LENGKAP: Resource Route untuk Request Nampan
        Route::resource('request-nampan', RequestNampanController::class)->except(['show', 'edit', 'update']);

        // Route tambahan untuk riwayat
        Route::get('/riwayat-request', [RequestNampanController::class, 'riwayatSaya'])->name('riwayat-request');
        Route::delete('/riwayat-request/{id}', [RequestNampanController::class, 'destroy'])->name('riwayat-request.destroy');

        // ✅ BACKWARD COMPATIBILITY: Route lama untuk menghindari breaking changes
        Route::get('/request-nampan-create', [RequestNampanController::class, 'create'])->name('request-nampan-create');
    });

// ============================
// ✅ TAMBAHAN: API Routes (Optional)
// ============================
Route::prefix('api')
    ->name('api.')
    ->middleware(['auth'])
    ->group(function () {
        // API untuk mendapatkan menu rolling
        Route::get('/menus/rolling/{days?}', [MenuController::class, 'previewRolling'])->name('menus.rolling');

        // API untuk mendapatkan menu hari ini
        Route::get('/menus/today', [MenuController::class, 'getTodayMenu'])->name('menus.today');

        // API untuk jadwal piket
        Route::get('/jadwal/petugas', [JadwalPiketController::class, 'jadwalPetugasApi'])->name('jadwal.petugas');
    });

// ============================
// ✅ TAMBAHAN: Fallback Routes
// ============================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});