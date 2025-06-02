<?php

namespace App\Http\Controllers;

use App\Models\KelompokPiket;
use Illuminate\Http\Request;

class KelompokPiketController extends Controller
{
    public function index()
    {
        return KelompokPiket::latest()->get(); // list semua kelompok
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'anggota' => 'required|string' // karena input dari form string
        ]);

        $anggotaArray = array_map('trim', explode(',', $validated['anggota']));

        $kelompok = KelompokPiket::create([
            'nama_kelompok' => $validated['nama_kelompok'],
            'anggota' => $anggotaArray
        ]);

        return redirect()->route('kelompok.index');
    }


    public function edit(KelompokPiket $kelompok)
    {
        return response()->json($kelompok);
    }

    public function update(Request $request, KelompokPiket $kelompok)
    {
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'anggota' => 'required|string'
        ]);

        $anggotaArray = array_map('trim', explode(',', $validated['anggota']));

        $kelompok->update([
            'nama_kelompok' => $validated['nama_kelompok'],
            'anggota' => $anggotaArray
        ]);

        return redirect()->route('kelompok.index');
    }


    public function destroy(KelompokPiket $kelompok)
    {
        $kelompok->delete();
        return response()->json(['message' => 'Kelompok piket dihapus']);
    }
}

