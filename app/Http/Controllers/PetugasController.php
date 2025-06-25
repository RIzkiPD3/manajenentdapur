<?php

namespace App\Http\Controllers;

use App\Http\Controllers\JadwalPiketController;
use App\Models\Menu;
use Carbon\Carbon;

class PetugasController extends Controller
{
    public function index()
    {
        $jadwalHariIni = JadwalPiketController::getJadwalHariIni();
        $menuHariIni = Menu::whereDate('tanggal', Carbon::today())
            ->orderBy('sesi', 'asc')
            ->get();

        return view('petugas.dashboard', compact('jadwalHariIni', 'menuHariIni'));
    }
}