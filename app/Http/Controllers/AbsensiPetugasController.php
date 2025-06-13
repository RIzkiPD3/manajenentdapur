<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiPetugas;
use App\Models\KelompokPiket;
use App\Models\SesiAbsensi;
use Carbon\Carbon;

class AbsensiPetugasController extends Controller
{
    public function index()
    {
        $semuaKelompok = KelompokPiket::orderBy('id')->get();

        // Cek apakah ada kelompok piket
        if ($semuaKelompok->isEmpty()) {
            return view('petugas.absensi.index', [
                'kelompok' => null,
                'sesiList' => SesiAbsensi::orderBy('waktu_mulai')->get(),
                'error' => 'Belum ada kelompok piket yang terdaftar'
            ]);
        }

        $hariKe = Carbon::now()->dayOfWeekIso - 1;
        $kelompok = $semuaKelompok->get($hariKe % $semuaKelompok->count());

        $sesiList = SesiAbsensi::orderBy('waktu_mulai')->get();

        return view('petugas.absensi.index', compact('kelompok', 'sesiList'));
    }

    public function store(Request $request, $tanggal)
    {
        $request->validate([
            'sesi_absensi_id' => 'required|exists:sesi_absensis,id',
            'daftar_hadir' => 'nullable|array',
            'daftar_hadir.*' => 'string'
        ]);

        $semuaKelompok = KelompokPiket::orderBy('id')->get();

        // Cek apakah ada kelompok piket
        if ($semuaKelompok->isEmpty()) {
            return redirect()->route('petugas.absensi.index')
                ->with('error', 'Tidak dapat menyimpan absensi. Belum ada kelompok piket yang terdaftar.');
        }

        $hariKe = Carbon::parse($tanggal)->dayOfWeekIso - 1;
        $kelompok = $semuaKelompok->get($hariKe % $semuaKelompok->count());

        // Cek apakah sudah ada absensi untuk sesi yang sama pada tanggal tersebut
        $existingAbsensi = AbsensiPetugas::where('tanggal', $tanggal)
            ->where('kelompok_piket_id', $kelompok->id)
            ->where('sesi_absensi_id', $request->sesi_absensi_id)
            ->first();

        if ($existingAbsensi) {
            return redirect()->route('petugas.absensi.index')
                ->with('error', 'Absensi untuk sesi ini sudah pernah dicatat hari ini.');
        }

        AbsensiPetugas::create([
            'tanggal' => $tanggal,
            'kelompok_piket_id' => $kelompok->id,
            'sesi_absensi_id' => $request->sesi_absensi_id,
            'daftar_hadir' => $request->daftar_hadir ?? [],
        ]);

        return redirect()->route('petugas.absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }
}