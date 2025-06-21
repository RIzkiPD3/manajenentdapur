<?php

namespace App\Http\Controllers;

use App\Models\RequestNampan;
use App\Models\JadwalPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestNampanController extends Controller
{
    /**
     * ✅ PERBAIKAN: Method index untuk angkatan
     * Menampilkan daftar request nampan milik user yang login
     */
    public function index()
    {
        // Jika user adalah angkatan, tampilkan request miliknya sendiri
        if (Auth::user()->role === 'angkatan') {
            $requests = RequestNampan::where('user_id', Auth::id())
                ->latest()
                ->get();

            return view('angkatan.riwayat-request', compact('requests'));
        }

        // Jika petugas/admin, tampilkan semua request
        $requests = RequestNampan::with('user')
            ->latest()
            ->get();

        return view('petugas.nampan.index', compact('requests'));
    }

    /**
     * Halaman form pengajuan request nampan oleh angkatan.
     */
    public function create()
    {
        // Ambil kelompok piket hari ini (opsional)
        $kelompokPiket = JadwalPiket::with('kelompok')
            ->whereDate('tanggal', today())
            ->first();

        return view('angkatan.request-nampan', compact('kelompokPiket'));
    }

    /**
     * ✅ PERBAIKAN: Method show untuk melihat detail request
     */
    public function show($id)
    {
        $request = RequestNampan::with('user')->findOrFail($id);

        // Pastikan hanya pemilik request atau admin/petugas yang bisa melihat
        if ($request->user_id !== Auth::id() && !in_array(Auth::user()->role, ['admin', 'petugas'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('angkatan.request-detail', compact('request'));
    }

    /**
     * ✅ PERBAIKAN: Method edit untuk mengedit request
     */
    public function edit($id)
    {
        $requestNampan = RequestNampan::findOrFail($id);

        // Pastikan hanya pemilik request yang bisa mengedit dan status masih pending
        if ($requestNampan->user_id !== Auth::id() || $requestNampan->status !== 'pending') {
            abort(403, 'Unauthorized action or request already processed.');
        }

        return view('angkatan.request-edit', compact('requestNampan'));
    }

    /**
     * ✅ PERBAIKAN: Method update untuk mengupdate request
     */
    public function update(Request $request, $id)
    {
        $requestNampan = RequestNampan::findOrFail($id);

        // Pastikan hanya pemilik request yang bisa mengupdate dan status masih pending
        if ($requestNampan->user_id !== Auth::id() || $requestNampan->status !== 'pending') {
            abort(403, 'Unauthorized action or request already processed.');
        }

        $request->validate([
            'jumlah_nampan' => 'required|integer|min:1|max:50',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $requestNampan->update([
            'jumlah_nampan' => $request->jumlah_nampan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('angkatan.riwayat-request')->with('success', 'Request nampan berhasil diupdate.');
    }

    /**
     * Simpan request nampan yang dikirim oleh angkatan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_nampan' => 'required|integer|min:1|max:50',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        RequestNampan::create([
            'user_id' => Auth::id(),
            'jumlah_nampan' => $request->jumlah_nampan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('angkatan.riwayat-request')->with('success', 'Request nampan berhasil dikirim.');
    }

    /**
     * ✅ PERBAIKAN: Method updateStatus untuk petugas
     */
    public function updateStatus(Request $request, $id)
    {
        // Pastikan hanya admin/petugas yang bisa mengupdate status
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            abort(403, 'Unauthorized action.');
        }

        $requestNampan = RequestNampan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
            'catatan_petugas' => 'nullable|string|max:1000',
        ]);

        $requestNampan->update([
            'status' => $request->status,
            'catatan_petugas' => $request->catatan_petugas,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Status request berhasil diupdate.');
    }

    /**
     * Santri melihat riwayat request miliknya sendiri
     */
    public function riwayatSaya()
    {
        $requests = RequestNampan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('angkatan.riwayat-request', compact('requests'));
    }

    /**
     * Petugas melihat semua riwayat permintaan
     */
    public function riwayatSemua()
    {
        $requests = RequestNampan::with('user')
            ->latest()
            ->get();

        // Hitung statistik untuk bulan ini
        $thisMonthCount = RequestNampan::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('petugas.nampan.riwayat', compact('requests', 'thisMonthCount'));
    }

    /**
     * Hapus request nampan
     */
    public function destroy($id)
    {
        $requestNampan = RequestNampan::findOrFail($id);

        // Pastikan hanya pemilik request atau admin/petugas yang bisa menghapus
        if ($requestNampan->user_id !== Auth::id() && !in_array(Auth::user()->role, ['admin', 'petugas'])) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan request masih bisa dihapus (status pending)
        if ($requestNampan->status !== 'pending' && Auth::user()->role === 'angkatan') {
            return redirect()->back()->with('error', 'Request yang sudah diproses tidak dapat dihapus.');
        }

        $requestNampan->delete();

        return redirect()->back()->with('success', 'Request nampan berhasil dihapus.');
    }
}