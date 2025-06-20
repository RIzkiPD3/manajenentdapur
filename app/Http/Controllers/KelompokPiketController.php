<?php

namespace App\Http\Controllers;

use App\Models\KelompokPiket;
use Illuminate\Http\Request;

class KelompokPiketController extends Controller
{
    /**
     * Menampilkan daftar semua kelompok piket.
     */
    public function index()
    {
        $kelompokList = KelompokPiket::orderBy('urutan')->get();
        return view('admin.kelompok.index', compact('kelompokList'));
    }

    /**
     * Menampilkan form untuk membuat kelompok baru.
     */
    public function create()
    {
        return view('admin.kelompok.create');
    }

    /**
     * Menyimpan data kelompok piket yang baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'anggota'       => 'required|array|min:1', // Ubah ke array
            'anggota.*'     => 'required|string|max:255', // Validasi setiap anggota
            'urutan'        => 'required|integer|unique:kelompok_pikets,urutan'
        ]);

        // Hapus spasi kosong dari setiap anggota
        $anggotaArray = array_map('trim', $validated['anggota']);
        $anggotaArray = array_filter($anggotaArray); // Hapus anggota kosong

        KelompokPiket::create([
            'nama_kelompok' => $validated['nama_kelompok'],
            'anggota'       => $anggotaArray,
            'urutan'        => $validated['urutan']
        ]);

        return redirect()->route('admin.kelompok.index')
                        ->with('success', 'Kelompok berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kelompok.
     */
    public function edit(KelompokPiket $kelompok)
    {
        return view('admin.kelompok.edit', compact('kelompok'));
    }

    /**
     * Memperbarui data kelompok piket.
     */
    public function update(Request $request, KelompokPiket $kelompok)
    {
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'anggota'       => 'required|array|min:1', // Ubah ke array
            'anggota.*'     => 'required|string|max:255', // Validasi setiap anggota
            'urutan'        => 'required|integer|unique:kelompok_pikets,urutan,' . $kelompok->id
        ]);

        // Hapus spasi kosong dari setiap anggota
        $anggotaArray = array_map('trim', $validated['anggota']);
        $anggotaArray = array_filter($anggotaArray); // Hapus anggota kosong

        $kelompok->update([
            'nama_kelompok' => $validated['nama_kelompok'],
            'anggota'       => $anggotaArray,
            'urutan'        => $validated['urutan']
        ]);

        return redirect()->route('admin.kelompok.index')
                        ->with('success', 'Kelompok berhasil diperbarui.');
    }

    /**
     * Menghapus data kelompok.
     */
    public function destroy(KelompokPiket $kelompok)
    {
        $kelompok->delete();
        return redirect()->route('admin.kelompok.index')
                        ->with('success', 'Kelompok berhasil dihapus.');
    }
}