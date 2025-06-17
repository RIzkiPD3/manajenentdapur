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
        // Tidak perlu mengirim data kelompok ke view jika tidak digunakan
        // Atau jika memang diperlukan, pastikan data yang dikirim sudah terformat dengan benar

        return view('angkatan.request-nampan');
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

       $requestNampan->delete();

       return redirect()->back()->with('success', 'Request nampan berhasil dihapus.');
   }
}