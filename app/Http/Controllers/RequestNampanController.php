<?php

namespace App\Http\Controllers;

use App\Models\RequestNampan;
use App\Models\JadwalPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestNampanController extends Controller
{
    // Untuk angkatan - kirim request
    public function create()
    {
        $today = now()->toDateString();
        $jadwal = JadwalPiket::where('tanggal', $today)->first();

        return response()->json([
            'kelompok_piket_id' => $jadwal?->kelompok_piket_id,
            'tanggal' => $today,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'jumlah_nampan' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $requestNampan = RequestNampan::create([
            'user_id' => Auth::id(),
            'kelompok_piket_id' => $request->kelompok_piket_id,
            'jumlah_nampan' => $request->jumlah_nampan,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json($requestNampan, 201);
    }

    // Untuk petugas - lihat semua request hari ini
    public function index()
    {
        $today = now()->toDateString();
        return RequestNampan::with('user')->where('tanggal', $today)->get();
    }
}
