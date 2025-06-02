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

Route::get('/', function () {
    return view('welcome');
});

// ===========================
// Autentikasi Manual
// ===========================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// ===========================
// Middleware Role & Auth
// ===========================

// Dashboard universal, langsung di-redirect sesuai role
Route::middleware(['auth', RoleRedirect::class])->get('/dashboard', function () {
    return null;
});


// ===========================
// ADMIN Routes
// ===========================
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::resource('kelompok', KelompokPiketController::class)->except(['show']);
    Route::resource('jadwal', JadwalPiketController::class)->except(['show']);
    Route::resource('sesi-absensi', SesiAbsensiController::class)->except(['show']);
});


// ===========================
// PETUGAS Routes
// ===========================
Route::middleware(['auth', PetugasMiddleware::class])->prefix('petugas')->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    });

    Route::get('absensi', [AbsensiPetugasController::class, 'index']);
    Route::post('absensi/{sesi}', [AbsensiPetugasController::class, 'store']);
    Route::get('request-nampan', [RequestNampanController::class, 'index']);
});


// ===========================
// ANGKATAN Routes
// ===========================
Route::middleware(['auth', AngkatanMiddleware::class])->prefix('angkatan')->group(function () {
    Route::get('/dashboard', function () {
        return view('angkatan.dashboard');
    });

    Route::get('request-nampan', [RequestNampanController::class, 'create']);
    Route::post('request-nampan', [RequestNampanController::class, 'store']);
});
