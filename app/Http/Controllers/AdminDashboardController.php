<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\KelompokPiket;
use App\Models\Menu;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalAngkatan = User::where('role', 'angkatan')->count();
        $totalKelompok = KelompokPiket::count();
        $totalMenu = Menu::count();

        // Menggunakan method getJadwalHariIni() dari JadwalPiketController
        $jadwalHariIni = JadwalPiketController::getJadwalHariIni();

        // Ambil menu hari ini (jika ada)
        $menuHariIni = Menu::whereDate('tanggal', Carbon::today())
            ->orderBy('sesi', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'totalAngkatan',
            'totalKelompok',
            'totalMenu',
            'jadwalHariIni',
            'menuHariIni'
        ));
    }
}