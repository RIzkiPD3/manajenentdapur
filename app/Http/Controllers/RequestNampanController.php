<?php

namespace App\Http\Controllers;

use App\Models\RequestNampan;
use App\Models\JadwalPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestNampanController extends Controller
{
    /**
     * Halaman form pengajuan request nampan oleh angkatan.
     */
    public function create()
    {
        $today = now()->toDateString();
        $kelompok = JadwalPiket::where('tanggal', $today)->first()?->kelompok;

        return view('angkatan.request-nampan', compact('kelompok'));
    }

    /**
     * Simpan request nampan yang dikirim oleh angkatan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'jumlah_nampan' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        RequestNampan::create([
            'user_id' => Auth::id(),
            'kelompok_piket_id' => $request->kelompok_piket_id,
            'jumlah_nampan' => $request->jumlah_nampan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Request nampan berhasil dikirim.');
    }

    /**
     * Petugas melihat semua request nampan yang masuk hari ini.
     */
    public function index()
    {
        $today = now()->toDateString();
        $requests = RequestNampan::with('user')->where('tanggal', $today)->get();

        return view('petugas.request-nampan', compact('requests'));
    }
}
