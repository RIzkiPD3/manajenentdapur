<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPetugas;
use App\Models\SesiAbsensi;
use App\Models\JadwalPiket;
use App\Models\KelompokPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AbsensiPetugasController extends Controller
{
    // Tampilkan daftar sesi hari ini & nama kelompok piket-nya
    public function index()
    {
        $today = now()->toDateString();

        // Ganti kolom 'tanggal' menjadi 'created_at'
        $sesiHariIni = SesiAbsensi::whereDate('created_at', $today)->get();

        $jadwal = JadwalPiket::with('kelompok')
            ->whereDate('created_at', $today)
            ->first(); // hanya 1 kelompok piket per hari

        return view('petugas.absensi.index', compact('sesiHariIni', 'jadwal'));
    }
}
