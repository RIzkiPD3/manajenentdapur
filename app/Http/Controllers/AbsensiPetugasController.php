<?php

namespace App\Http\Controllers;

use App\Models\{AbsensiPetugas, SesiAbsensi, JadwalPiket, KelompokPiket};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AbsensiPetugasController extends Controller
{
    // Tampilkan daftar sesi hari ini & nama kelompok piket-nya
    public function index()
    {
        $today = now()->toDateString();

        $sesiHariIni = SesiAbsensi::where('tanggal', $today)->get();
        $jadwal = JadwalPiket::with('kelompok')
                    ->where('tanggal', $today)
                    ->first(); // hanya 1 kelompok piket per hari

         return view('petugas.absensi.index', [
            'sesi' => $sesiHariIni,   // -> SesiAbsensi::where('tanggal', today())->get()
            'kelompok' => $jadwal?->kelompok // -> JadwalPiket::where('tanggal', today())->first()->kelompok
                    ]);
    }

    // Simpan absensi petugas untuk sesi tertentu
    public function store(Request $request, $sesiId)
    {
        $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'absensi' => 'required|array',
            'absensi.*.nama_petugas' => 'required|string',
            'absensi.*.status_hadir' => 'required|boolean',
        ]);

        foreach ($request->absensi as $item) {
            AbsensiPetugas::updateOrCreate(
                [
                    'sesi_absensi_id' => $sesiId,
                    'kelompok_piket_id' => $request->kelompok_piket_id,
                    'nama_petugas' => $item['nama_petugas'],
                ],
                [
                    'status_hadir' => $item['status_hadir'],
                    'waktu_isi' => Carbon::now(),
                ]
            );
        }

        return response()->json(['message' => 'Absensi petugas berhasil disimpan']);
    }
}

