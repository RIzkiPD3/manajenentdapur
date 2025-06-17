<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\KelompokPiket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalPiketController extends Controller
{
    /**
     * Tampilkan daftar semua jadwal piket, urut berdasarkan hari dalam seminggu.
     */
    public function index()
    {
        $jadwals = JadwalPiket::with('kelompok')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get();

        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Tampilkan form untuk membuat jadwal baru.
     */
    public function create()
    {
        $kelompok = KelompokPiket::all(); // Ubah dari null ke data kelompok

        return view('admin.jadwal.create', compact('kelompok'));
    }

    /**
     * Simpan jadwal baru.
     */
    public function store(Request $request)
    {
        // Debug: Cek nilai yang diterima
        \Log::info('Data yang diterima:', $request->all());

        $validated = $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
        ], [
            'hari.required' => 'Pilih hari terlebih dahulu.',
            'hari.in' => 'Hari yang dipilih tidak valid. Pilih salah satu hari.',
            'kelompok_piket_id.required' => 'Pilih kelompok piket terlebih dahulu.',
            'kelompok_piket_id.exists' => 'Kelompok piket yang dipilih tidak valid.',
        ]);

        // Cek apakah jadwal untuk hari dan kelompok sudah ada
        $existingJadwal = JadwalPiket::where('kelompok_piket_id', $validated['kelompok_piket_id'])
            ->where('hari', ucfirst($validated['hari']))
            ->first();

        if ($existingJadwal) {
            return back()->withErrors(['hari' => 'Jadwal untuk kelompok ini pada hari tersebut sudah ada.'])
                        ->withInput();
        }

        // Konversi hari ke format yang sesuai untuk database (huruf besar di awal)
        $validated['hari'] = ucfirst($validated['hari']); // senin -> Senin

        // Simpan ke database
        JadwalPiket::create($validated);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit jadwal.
     */
    public function edit(JadwalPiket $jadwal)
    {
        $kelompokPikets = KelompokPiket::all();

        return view('admin.jadwal.edit', compact('jadwal', 'kelompokPikets'));
    }

    /**
     * Perbarui jadwal.
     */
    public function update(Request $request, JadwalPiket $jadwal)
    {
        // Debug: Cek nilai yang diterima
        \Log::info('Data update yang diterima:', $request->all());

        $validated = $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
        ], [
            'hari.required' => 'Pilih hari terlebih dahulu.',
            'hari.in' => 'Hari yang dipilih tidak valid. Pilih salah satu hari.',
            'kelompok_piket_id.required' => 'Pilih kelompok piket terlebih dahulu.',
            'kelompok_piket_id.exists' => 'Kelompok piket yang dipilih tidak valid.',
        ]);

        // Cek apakah jadwal untuk hari dan kelompok sudah ada (kecuali untuk data yang sedang diedit)
        $existingJadwal = JadwalPiket::where('kelompok_piket_id', $validated['kelompok_piket_id'])
            ->where('hari', ucfirst($validated['hari']))
            ->where('id', '!=', $jadwal->id)
            ->first();

        if ($existingJadwal) {
            return back()->withErrors(['hari' => 'Jadwal untuk kelompok ini pada hari tersebut sudah ada.'])
                        ->withInput();
        }

        // Konversi hari ke format yang sesuai untuk database
        $validated['hari'] = ucfirst($validated['hari']); // senin -> Senin

        // Update data
        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Hapus jadwal.
     */
    public function destroy(JadwalPiket $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Tampilkan jadwal untuk petugas
     */
    public function jadwalPetugas()
    {
        // Ambil hari ini dalam bahasa Indonesia
        $hariMapping = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $hariInggris = Carbon::now()->format('l');
        $hariIni = $hariMapping[$hariInggris];

        // Untuk konsistensi dengan view yang menggunakan $hari
        $hari = $hariIni;

        // Ambil semua jadwal dengan relasi kelompok
        $jadwals = JadwalPiket::with('kelompok')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get();

        // Ambil jadwal untuk hari ini (gunakan first() karena view mengharapkan single object)
        $jadwalHariIni = JadwalPiket::with('kelompok')
            ->where('hari', $hariIni)
            ->first();

        // Set variabel kelompok dan message sesuai kebutuhan view
        $kelompok = null;
        $message = null;

        if ($jadwalHariIni && $jadwalHariIni->kelompok) {
            $kelompok = $jadwalHariIni->kelompok;
        } else {
            $message = 'Tidak ada jadwal piket untuk hari ini (' . $hariIni . ').';
        }

        // Ambil semua kelompok piket untuk referensi
        $kelompokPikets = KelompokPiket::all();

        return view('petugas.jadwal.index', compact(
            'jadwals',
            'jadwalHariIni',
            'hariIni',
            'hari',          // Variabel yang dibutuhkan view
            'kelompok',      // Single kelompok object
            'message',       // Pesan jika tidak ada jadwal
            'kelompokPikets'
        ));
    }

    /**
     * Tampilkan jadwal berdasarkan hari tertentu
     */
    public function jadwalByHari($hari)
    {
        $validHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        if (!in_array($hari, $validHari)) {
            abort(404, 'Hari tidak valid');
        }

        $jadwals = JadwalPiket::with('kelompok')
            ->where('hari', $hari)
            ->get();

        return view('petugas.jadwal.by-hari', compact('jadwals', 'hari'));
    }

    /**
     * Tandai tugas piket sebagai selesai (untuk endpoint AJAX)
     */
    public function tandaiSelesai(Request $request)
    {
        try {
            $validated = $request->validate([
                'kelompok_id' => 'required|exists:kelompok_pikets,id',
                'tanggal' => 'required|date',
                'catatan' => 'nullable|string'
            ]);

            // Logic untuk menyimpan data penyelesaian tugas
            // Sesuaikan dengan model yang Anda gunakan untuk tracking penyelesaian tugas

            return response()->json([
                'success' => true,
                'message' => 'Tugas piket berhasil ditandai sebagai selesai!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}