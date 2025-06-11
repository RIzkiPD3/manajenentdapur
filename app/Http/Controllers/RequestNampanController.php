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
        // Ambil kelompok piket pertama yang tersedia atau berdasarkan logika tertentu
        $kelompok = JadwalPiket::first()?->kelompok;

        return view('angkatan.request-nampan', compact('kelompok'));
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

        return redirect()->back()->with('success', 'Request nampan berhasil dikirim.');
    }

   /**
    * Petugas melihat semua request nampan yang masuk.
    */
   public function index()
   {
       $requests = RequestNampan::with('user')
           ->latest()
           ->get();

       return view('petugas.nampan.index', compact('requests'));
   }

   /**
    * Santri melihat riwayat request miliknya sendiri
    */
   public function riwayatSaya()
   {
       $requests = RequestNampan::with('kelompok')
           ->where('user_id', Auth::id())
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

       return view('petugas.nampan.riwayat', compact('requests'));
   }

   /**
    * Update status request nampan (untuk petugas)
    */
   public function updateStatus(Request $request, $id)
   {
       $request->validate([
           'status' => 'required|in:pending,approved,rejected',
           'catatan_petugas' => 'nullable|string|max:500'
       ]);

       $requestNampan = RequestNampan::findOrFail($id);
       $requestNampan->update([
           'status' => $request->status,
           'catatan_petugas' => $request->catatan_petugas,
           'processed_at' => now(),
           'processed_by' => Auth::id()
       ]);

       return redirect()->back()->with('success', 'Status request berhasil diperbarui.');
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

       $requestNampan->delete();

       return redirect()->back()->with('success', 'Request nampan berhasil dihapus.');
   }
}