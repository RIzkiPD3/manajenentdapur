<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\KelompokPiket;
use App\Models\Menu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class JadwalPiketController extends Controller
{
    /**
     * Display a listing of the resource (untuk admin).
     */
    public function index()
    {
        $jadwal = JadwalPiket::with('kelompok')->get();

        $events = $jadwal->map(function ($item) {
            return [
                'title' => 'Kelompok: ' . ($item->kelompok->nama_kelompok ?? 'N/A'),
                'start' => $item->tanggal, // pastikan ini bertipe YYYY-MM-DD
                'allDay' => true
            ];
        });

        return view('admin.jadwal.index', [
            'events' => $events
        ]);
    }

    /**
     * Display jadwal untuk petugas
     */
    public function jadwalPetugas()
    {
        $hari = Carbon::now()->translatedFormat('l, d F Y');
        $jadwalHariIni = self::getJadwalHariIni();
        $kelompok = $jadwalHariIni ? $jadwalHariIni->kelompok : null;
        $message = null;

        if (!$kelompok) {
            $kelompokCount = KelompokPiket::count();
            if ($kelompokCount == 0) {
                $message = 'Belum ada kelompok piket yang terdaftar. Silakan hubungi admin untuk mengatur jadwal.';
            } else {
                $message = 'Tidak ada jadwal piket untuk hari ini. Silakan hubungi admin untuk mengatur jadwal.';
            }
        }

        // Ambil menu hari ini
        $menuHariIni = Menu::whereDate('tanggal', Carbon::today())
            ->orderBy('sesi', 'asc')
            ->get();

        return view('petugas.jadwal.index', compact('hari', 'kelompok', 'message', 'menuHariIni'));
    }

    /**
     * Get jadwal untuk hari ini - Method utama untuk mendapatkan jadwal
     * FIXED: Improved error handling and validation
     */
    public static function getJadwalHariIni()
    {
        try {
            $hariInggris = Carbon::now()->format('l');
            $hariMapping = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];

            $hariIndonesia = $hariMapping[$hariInggris];

            // Prioritas 1: Jadwal rolling yang sudah di-generate untuk hari ini
            $jadwalHariIni = JadwalPiket::with('kelompok')
                ->where('hari', $hariIndonesia)
                ->whereDate('tanggal', Carbon::today())
                ->first();

            if ($jadwalHariIni && $jadwalHariIni->kelompok) {
                Log::info('Found scheduled piket for today: ' . $jadwalHariIni->kelompok->nama_kelompok);
                return $jadwalHariIni;
            }

            // Prioritas 2: Jadwal berdasarkan hari saja (template jadwal)
            $jadwalByHari = JadwalPiket::with('kelompok')
                ->where('hari', $hariIndonesia)
                ->whereNull('tanggal')
                ->first();

            if ($jadwalByHari && $jadwalByHari->kelompok) {
                Log::info('Found template piket for today: ' . $jadwalByHari->kelompok->nama_kelompok);
                return $jadwalByHari;
            }

            // Prioritas 3: Sistem fallback otomatis berdasarkan rotasi kelompok
            $kelompokList = KelompokPiket::orderBy('urutan')->get();

            if ($kelompokList->count() > 0) {
                $dayOfWeek = Carbon::now()->dayOfWeek;
                $index = $dayOfWeek % $kelompokList->count();
                $kelompok = $kelompokList[$index];

                // Buat objek jadwal sementara untuk fallback
                $jadwalFallback = new JadwalPiket();
                $jadwalFallback->hari = $hariIndonesia;
                $jadwalFallback->tanggal = Carbon::today();
                $jadwalFallback->kelompok_piket_id = $kelompok->id;

                // Set relasi kelompok secara manual
                $jadwalFallback->setRelation('kelompok', $kelompok);

                Log::info('Using fallback piket for today: ' . $kelompok->nama_kelompok);
                return $jadwalFallback;
            }

            Log::warning('No piket groups found');
            return null;

        } catch (\Exception $e) {
            Log::error('Error in getJadwalHariIni: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            return null;
        }
    }

    /**
     * Get jadwal untuk minggu ini - Method yang hilang
     */
    public static function getJadwalMingguIni()
    {
        try {
            $startOfWeek = Carbon::now()->startOfWeek(); // Senin
            $endOfWeek = Carbon::now()->endOfWeek(); // Minggu

            // Ambil jadwal yang sudah di-generate untuk minggu ini
            $jadwalMingguIni = JadwalPiket::with('kelompok')
                ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                ->orderBy('tanggal', 'asc')
                ->get();

            // Jika tidak ada jadwal yang di-generate, buat jadwal fallback
            if ($jadwalMingguIni->isEmpty()) {
                $kelompokList = KelompokPiket::orderBy('urutan')->get();

                if ($kelompokList->count() > 0) {
                    $jadwalFallback = collect();

                    // Generate jadwal untuk 7 hari ke depan mulai dari hari Senin
                    for ($i = 0; $i < 7; $i++) {
                        $tanggal = $startOfWeek->copy()->addDays($i);
                        $hariInggris = $tanggal->format('l');

                        $hariMapping = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];

                        $hariIndonesia = $hariMapping[$hariInggris];

                        // Rotasi kelompok berdasarkan hari
                        $kelompokIndex = $i % $kelompokList->count();
                        $kelompok = $kelompokList[$kelompokIndex];

                        $jadwalTemp = new JadwalPiket();
                        $jadwalTemp->hari = $hariIndonesia;
                        $jadwalTemp->tanggal = $tanggal;
                        $jadwalTemp->kelompok_piket_id = $kelompok->id;
                        $jadwalTemp->setRelation('kelompok', $kelompok);

                        $jadwalFallback->push($jadwalTemp);
                    }

                    return $jadwalFallback;
                }
            }

            return $jadwalMingguIni;

        } catch (\Exception $e) {
            Log::error('Error in getJadwalMingguIni: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Get jadwal untuk bulan ini
     */
    public static function getJadwalBulanIni()
    {
        try {
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $jadwalBulanIni = JadwalPiket::with('kelompok')
                ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
                ->orderBy('tanggal', 'asc')
                ->get();

            return $jadwalBulanIni;

        } catch (\Exception $e) {
            Log::error('Error in getJadwalBulanIni: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Get jadwal untuk hari tertentu
     */
    public static function getJadwalByDate($tanggal)
    {
        try {
            $date = Carbon::parse($tanggal);
            $hariInggris = $date->format('l');

            $hariMapping = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];

            $hariIndonesia = $hariMapping[$hariInggris];

            // Cari jadwal spesifik untuk tanggal tersebut
            $jadwal = JadwalPiket::with('kelompok')
                ->where('hari', $hariIndonesia)
                ->whereDate('tanggal', $date)
                ->first();

            if ($jadwal && $jadwal->kelompok) {
                return $jadwal;
            }

            // Fallback ke jadwal template berdasarkan hari
            $jadwalTemplate = JadwalPiket::with('kelompok')
                ->where('hari', $hariIndonesia)
                ->whereNull('tanggal')
                ->first();

            if ($jadwalTemplate && $jadwalTemplate->kelompok) {
                return $jadwalTemplate;
            }

            return null;

        } catch (\Exception $e) {
            Log::error('Error in getJadwalByDate: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelompokList = KelompokPiket::orderBy('urutan')->get();
        return view('admin.jadwal.create', compact('kelompokList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'nullable|date',
        ]);

        JadwalPiket::create([
            'kelompok_piket_id' => $request->kelompok_piket_id,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwal = JadwalPiket::with('kelompok')->findOrFail($id);
        $kelompokList = KelompokPiket::orderBy('urutan')->get();

        return view('admin.jadwal.edit', compact('jadwal', 'kelompokList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelompok_piket_id' => 'required|exists:kelompok_pikets,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'nullable|date',
        ]);

        $jadwal = JadwalPiket::findOrFail($id);
        $jadwal->update([
            'kelompok_piket_id' => $request->kelompok_piket_id,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = JadwalPiket::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Form untuk generate rolling jadwal
     */
    public function generateForm()
    {
        return view('admin.jadwal.generate');
    }

    /**
     * Method untuk generate jadwal rolling (untuk admin)
     */
    public function generateRolling(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'jumlah_hari' => 'required|integer|min:1|max:365'
        ]);

        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $jumlahHari = $request->jumlah_hari;
        $kelompokList = KelompokPiket::orderBy('urutan')->get();

        if ($kelompokList->count() == 0) {
            return back()->with('error', 'Belum ada kelompok piket yang tersedia.');
        }

        // Hapus jadwal lama yang akan di-replace
        JadwalPiket::whereBetween('tanggal', [
            $tanggalMulai,
            $tanggalMulai->copy()->addDays($jumlahHari - 1)
        ])->delete();

        // Generate jadwal baru
        for ($i = 0; $i < $jumlahHari; $i++) {
            $tanggal = $tanggalMulai->copy()->addDays($i);
            $hariInggris = $tanggal->format('l');

            $hariMapping = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];

            $hariIndonesia = $hariMapping[$hariInggris];

            // Rotasi kelompok berdasarkan nomor hari
            $kelompokIndex = $i % $kelompokList->count();
            $kelompok = $kelompokList[$kelompokIndex];

            // Pastikan kelompok valid sebelum membuat jadwal
            if (!$kelompok || !$kelompok->id) {
                continue;
            }

            try {
                JadwalPiket::create([
                    'kelompok_piket_id' => $kelompok->id,
                    'hari' => $hariIndonesia,
                    'tanggal' => $tanggal
                ]);
            } catch (\Exception $e) {
                Log::error('Error creating jadwal: ' . $e->getMessage());
                return back()->with('error', 'Error saat membuat jadwal: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.jadwal.index')
            ->with('success', "Jadwal rolling berhasil di-generate untuk {$jumlahHari} hari ke depan.");
    }

    /**
     * Get jadwal untuk dashboard dengan informasi tambahan
     */
    public static function getJadwalDashboard()
    {
        $jadwalHariIni = self::getJadwalHariIni();
        $jadwalMingguIni = self::getJadwalMingguIni();

        return [
            'jadwal_hari_ini' => $jadwalHariIni,
            'jadwal_minggu_ini' => $jadwalMingguIni,
            'total_kelompok' => KelompokPiket::count(),
            'kelompok_aktif_hari_ini' => $jadwalHariIni ? $jadwalHariIni->kelompok : null,
            'total_jadwal_minggu_ini' => $jadwalMingguIni ? $jadwalMingguIni->count() : 0
        ];
    }

    /**
     * API untuk mendapatkan jadwal (untuk AJAX calls)
     */
    public function getJadwalApi(Request $request)
    {
        $type = $request->get('type', 'hari_ini');

        switch ($type) {
            case 'hari_ini':
                $jadwal = self::getJadwalHariIni();
                break;
            case 'minggu_ini':
                $jadwal = self::getJadwalMingguIni();
                break;
            case 'bulan_ini':
                $jadwal = self::getJadwalBulanIni();
                break;
            default:
                $jadwal = null;
        }

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ]);
    }
}