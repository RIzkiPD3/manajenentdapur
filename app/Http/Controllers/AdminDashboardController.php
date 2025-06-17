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

        // Hari ini
        $hariIni = strtolower(Carbon::now()->locale('id')->isoFormat('dddd'));

        // Ambil jadwal hari ini
        $jadwalHariIni = JadwalPiket::with(['kelompok', 'menu'])
            ->where('hari', $hariIni)
            ->first();

        return view('admin.dashboard', compact(
            'totalAngkatan',
            'totalKelompok',
            'totalMenu',
            'jadwalHariIni'
        ));
    }
}
