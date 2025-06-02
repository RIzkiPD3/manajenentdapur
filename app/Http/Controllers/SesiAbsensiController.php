<?php

namespace App\Http\Controllers;

use App\Models\SesiAbsensi;
use Illuminate\Http\Request;

class SesiAbsensiController extends Controller
{
    public function index()
    {
        return SesiAbsensi::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sesi' => 'required|string|max:50',
            'waktu_mulai' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
        ]);

        $sesi = SesiAbsensi::create($validated);
        return response()->json($sesi, 201);
    }

    public function edit(SesiAbsensi $sesi_absensi)
    {
        return response()->json($sesi_absensi);
    }

    public function update(Request $request, SesiAbsensi $sesi_absensi)
    {
        $validated = $request->validate([
            'nama_sesi' => 'required|string|max:50',
            'waktu_mulai' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
        ]);

        $sesi_absensi->update($validated);
        return response()->json($sesi_absensi);
    }

    public function destroy(SesiAbsensi $sesi_absensi)
    {
        $sesi_absensi->delete();
        return response()->json(['message' => 'Sesi absensi dihapus']);
    }
}
