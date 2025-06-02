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
            'anggota' => 'required|array|min:1',
            'anggota.*' => 'string'
        ]);

        $kelompok = KelompokPiket::create($validated);
        return response()->json($kelompok, 201);
    }

    public function edit(KelompokPiket $kelompok)
    {
        return response()->json($kelompok);
    }

    public function update(Request $request, KelompokPiket $kelompok)
    {
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'anggota' => 'required|array|min:1',
            'anggota.*' => 'string'
        ]);

        $kelompok->update($validated);
        return response()->json($kelompok);
    }

    public function destroy(KelompokPiket $kelompok)
    {
        $kelompok->delete();
        return response()->json(['message' => 'Kelompok piket dihapus']);
    }
}

