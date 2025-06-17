<?php

namespace App\Http\Controllers;

use App\Models\KelompokPiket;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardAngkatanController extends Controller
{
    public function index()
    {
        // Debug: ambil semua data untuk testing
        $allKelompok = KelompokPiket::all();
        $allMenu = Menu::all();

        // Ambil kelompok piket hari ini (misalnya berdasarkan rotasi mingguan)
        $kelompokHariIni = $this->getKelompokPiketHariIni();

        // Ambil menu hari ini (3 menu terbaru)
        $menuHariIni = Menu::latest()->take(3)->get();

        // Debug - uncomment baris ini untuk melihat data
        // dd($kelompokHariIni, $menuHariIni, $allKelompok, $allMenu);

        return view('angkatan.dashboard', compact('kelompokHariIni', 'menuHariIni'));
    }

    /**
     * Logic untuk menentukan kelompok piket hari ini
     * Bisa disesuaikan dengan kebutuhan (rotasi harian, mingguan, dll)
     */
    private function getKelompokPiketHariIni()
    {
        $totalKelompok = KelompokPiket::count();

        if ($totalKelompok == 0) {
            return null;
        }

        // Rotasi berdasarkan hari dalam minggu (0-6)
        $hariIni = date('w'); // 0 = Minggu, 1 = Senin, dst

        // Ambil kelompok berdasarkan urutan rotasi
        $indexKelompok = $hariIni % $totalKelompok;

        return KelompokPiket::skip($indexKelompok)->first();
    }
}