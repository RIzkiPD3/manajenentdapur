<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\KelompokPiket;
use Illuminate\Http\Request;

class JadwalPiketController extends Controller
{
    public function index()
    {
        return JadwalPiket::with('kelompok')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'tanggal' => 'required|date',
        ]);

        $jadwal = JadwalPiket::create($validated);
        return response()->json($jadwal, 201);
    }

    public function edit(JadwalPiket $jadwal)
    {
        return response()->json($jadwal->load('kelompok'));
    }

    public function update(Request $request, JadwalPiket $jadwal)
    {
        $validated = $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'tanggal' => 'required|date',
        ]);

        $jadwal->update($validated);
        return response()->json($jadwal);
    }

    public function destroy(JadwalPiket $jadwal)
    {
        $jadwal->delete();
        return response()->json(['message' => 'Jadwal piket dihapus']);
    }
}
