<?php

namespace App\Http\Controllers;

use App\Models\SesiAbsensi;
use Illuminate\Http\Request;

class SesiAbsensiController extends Controller
{
    /**
     * Tampilkan daftar sesi absensi.
     */
    public function index()
    {
        $sesi = SesiAbsensi::latest()->get();
        return view('admin.sesi-absensi.index', compact('sesi'));
    }

    /**
     * Tampilkan form tambah sesi absensi.
     */
    public function create()
    {
        return view('admin.sesi-absensi.create');
    }

    /**
     * Simpan sesi absensi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_sesi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        SesiAbsensi::create([
            'nama_sesi'     => $request->nama_sesi,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('admin.sesi-absensi.index')->with('success', 'Sesi berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit sesi absensi.
     */
    public function edit(SesiAbsensi $sesi_absensi)
    {
        return view('admin.sesi-absensi.edit', ['sesi' => $sesi_absensi]);
    }

    /**
     * Perbarui sesi absensi yang ada.
     * FIXED: Parameter sekarang menggunakan $sesi_absensi agar sesuai dengan route binding
     */
    public function update(Request $request, SesiAbsensi $sesi_absensi)
    {
        $request->validate([
            'nama_sesi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        $sesi_absensi->update([
            'nama_sesi'     => $request->nama_sesi,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('admin.sesi-absensi.index')
                         ->with('success', 'Sesi absensi berhasil diperbarui.');
    }

    /**
     * Hapus sesi absensi dari database.
     * FIXED: Parameter juga disesuaikan untuk konsistensi
     */
    public function destroy(SesiAbsensi $sesi_absensi)
    {
        $sesi_absensi->delete();
        return redirect()->route('admin.sesi-absensi.index')
                         ->with('success', 'Sesi absensi berhasil dihapus.');
    }
}