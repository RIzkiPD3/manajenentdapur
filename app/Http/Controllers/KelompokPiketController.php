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
        $kelompokList = KelompokPiket::latest()->get(); // ✅ Ubah nama variable
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
            'anggota' => 'required|array|min:1',
            'anggota.*' => 'required|string|max:255',
        ]);

        // Filter anggota yang kosong dan trim whitespace
        $anggotaArray = array_filter(
            array_map('trim', $validated['anggota']),
            function($anggota) {
                return !empty($anggota);
            }
        );

        KelompokPiket::create([
            'nama_kelompok' => $validated['nama_kelompok'],
            'anggota' => array_values($anggotaArray)
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
            'anggota' => 'required|array|min:1',
            'anggota.*' => 'required|string|max:255',
        ]);

        // Filter anggota yang kosong dan trim whitespace
        $anggotaArray = array_filter(
            array_map('trim', $validated['anggota']),
            function($anggota) {
                return !empty($anggota);
            }
        );

        $kelompok->update([
            'nama_kelompok' => $validated['nama_kelompok'],
            'anggota' => array_values($anggotaArray)
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