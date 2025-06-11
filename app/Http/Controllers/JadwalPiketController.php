<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\KelompokPiket;
use Illuminate\Http\Request;

class JadwalPiketController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPiket::with('kelompok')->latest()->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $kelompok = KelompokPiket::all();
        return view('admin.jadwal.create', compact('kelompok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|enum:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
        ]);

        JadwalPiket::create($request->only('hari', 'kelompok_piket_id'));
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalPiket $jadwal)
    {
        $kelompok = KelompokPiket::all();
        return view('admin.jadwal.edit', compact('jadwal', 'kelompok'));
    }

    public function update(Request $request, JadwalPiket $jadwal)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
        ]);

        $jadwal->update($request->only('tanggal', 'kelompok_piket_id'));
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(JadwalPiket $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function jadwalPetugas()
    {
        $jadwal = JadwalPiket::with('kelompok', 'menu')->latest()->get();
        return view('petugas.jadwal.index', compact('jadwal'));
    }

}
