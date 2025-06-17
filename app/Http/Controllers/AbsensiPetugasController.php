<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiPetugas;
use App\Models\KelompokPiket;
use App\Models\SesiAbsensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AbsensiPetugasController extends Controller
{
    /**
     * Menampilkan halaman utama absensi
     */
    public function index()
    {
        $semuaKelompok = KelompokPiket::orderBy('id')->get();

        // Cek apakah ada kelompok piket
        if ($semuaKelompok->isEmpty()) {
            return view('petugas.absensi.index', [
                'kelompok' => null,
                'sesiList' => SesiAbsensi::orderBy('waktu_mulai')->get(),
                'statusOptions' => AbsensiPetugas::getAvailableStatuses(),
                'error' => 'Belum ada kelompok piket yang terdaftar'
            ]);
        }

        // Menentukan kelompok berdasarkan hari
        $hariKe = Carbon::now()->dayOfWeekIso - 1;
        $kelompok = $semuaKelompok->get($hariKe % $semuaKelompok->count());

        $sesiList = SesiAbsensi::orderBy('waktu_mulai')->get();
        $statusOptions = AbsensiPetugas::getAvailableStatuses();

        // Ambil absensi hari ini untuk ditampilkan
        $absensiHariIni = AbsensiPetugas::whereDate('created_at', Carbon::today())
            ->where('kelompok_piket_id', $kelompok->id)
            ->with(['sesi'])
            ->orderBy('sesi_absensi_id')
            ->orderBy('nama_petugas')
            ->get();

        return view('petugas.absensi.index', compact(
            'kelompok',
            'sesiList',
            'statusOptions',
            'absensiHariIni'
        ));
    }

    /**
     * Menampilkan absensi untuk tanggal tertentu
     */
    public function show($tanggal)
    {
        // Validasi format tanggal
        try {
            $date = Carbon::createFromFormat('Y-m-d', $tanggal);
        } catch (\Exception $e) {
            return redirect()->route('petugas.absensi.index')
                ->with('error', 'Format tanggal tidak valid. Gunakan format: YYYY-MM-DD');
        }

        // Ambil data absensi untuk tanggal tersebut
        $absensiList = AbsensiPetugas::whereDate('created_at', $tanggal)
            ->with(['kelompok', 'sesi'])
            ->orderBy('sesi_absensi_id')
            ->orderBy('nama_petugas')
            ->get();

        // Ambil data kelompok untuk tanggal tersebut
        $semuaKelompok = KelompokPiket::orderBy('id')->get();
        $hariKe = $date->dayOfWeekIso - 1;
        $kelompokHari = $semuaKelompok->isNotEmpty() ?
            $semuaKelompok->get($hariKe % $semuaKelompok->count()) : null;

        // Ambil sesi absensi
        $sesiList = SesiAbsensi::orderBy('waktu_mulai')->get();
        $statusOptions = AbsensiPetugas::getAvailableStatuses();

        return view('petugas.absensi.show', compact(
            'absensiList',
            'tanggal',
            'kelompokHari',
            'sesiList',
            'statusOptions'
        ));
    }

    /**
     * Menyimpan absensi individual
     */
    public function store(Request $request, $tanggal)
    {
        // Validasi format tanggal
        try {
            $date = Carbon::createFromFormat('Y-m-d', $tanggal);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Format tanggal tidak valid');
        }

        $request->validate([
            'sesi_absensi_id' => 'required|exists:sesi_absensis,id',
            'nama_petugas' => 'required|string|max:255',
            'status' => 'required|in:hadir,sakit,izin,alpha',
            'daftar_hadir' => 'nullable|array',
            'daftar_hadir.*' => 'string'
        ]);

        $semuaKelompok = KelompokPiket::orderBy('id')->get();

        // Cek apakah ada kelompok piket
        if ($semuaKelompok->isEmpty()) {
            return redirect()->route('petugas.absensi.index')
                ->with('error', 'Tidak dapat menyimpan absensi. Belum ada kelompok piket yang terdaftar.');
        }

        $hariKe = $date->dayOfWeekIso - 1;
        $kelompok = $semuaKelompok->get($hariKe % $semuaKelompok->count());

        // Cek apakah petugas sudah absen pada tanggal dan sesi yang sama
        $existingAbsensi = AbsensiPetugas::whereDate('created_at', $tanggal)
            ->where('kelompok_piket_id', $kelompok->id)
            ->where('sesi_absensi_id', $request->sesi_absensi_id)
            ->where('nama_petugas', $request->nama_petugas)
            ->first();

        if ($existingAbsensi) {
            return redirect()->back()
                ->with('error', 'Petugas ' . $request->nama_petugas . ' sudah melakukan absensi untuk sesi ini pada tanggal ' . $tanggal);
        }

        try {
            // Buat absensi dengan tanggal yang sesuai
            $absensi = new AbsensiPetugas([
                'kelompok_piket_id' => $kelompok->id,
                'sesi_absensi_id' => $request->sesi_absensi_id,
                'nama_petugas' => $request->nama_petugas,
                'status' => $request->status,
                'daftar_hadir' => $request->daftar_hadir ?? [],
            ]);

            // Set created_at sesuai tanggal yang diminta
            $absensi->created_at = $date;
            $absensi->updated_at = $date;
            $absensi->save();

            $statusLabel = AbsensiPetugas::getAvailableStatuses()[$request->status];

            return redirect()->back()
                ->with('success', "Absensi berhasil disimpan. {$request->nama_petugas} - Status: {$statusLabel}");

        } catch (\Exception $e) {
            Log::error('Error saving absensi: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan absensi');
        }
    }

    /**
     * Menyimpan absensi dalam bentuk bulk/batch
     */
    public function bulkStore(Request $request, $tanggal)
    {
        // Validasi format tanggal
        try {
            $date = Carbon::createFromFormat('Y-m-d', $tanggal);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Format tanggal tidak valid');
        }

        $request->validate([
            'sesi_absensi_id' => 'required|exists:sesi_absensis,id',
            'absensi' => 'required|array',
            'absensi.*.nama_petugas' => 'required|string|max:255',
            'absensi.*.status' => 'required|in:hadir,sakit,izin,alpha',
        ]);

        $semuaKelompok = KelompokPiket::orderBy('id')->get();

        if ($semuaKelompok->isEmpty()) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menyimpan absensi. Belum ada kelompok piket yang terdaftar.');
        }

        $hariKe = $date->dayOfWeekIso - 1;
        $kelompok = $semuaKelompok->get($hariKe % $semuaKelompok->count());

        $berhasil = 0;
        $gagal = 0;
        $errors = [];

        foreach ($request->absensi as $data) {
            // Cek duplikasi
            $existingAbsensi = AbsensiPetugas::whereDate('created_at', $tanggal)
                ->where('kelompok_piket_id', $kelompok->id)
                ->where('sesi_absensi_id', $request->sesi_absensi_id)
                ->where('nama_petugas', $data['nama_petugas'])
                ->first();

            if (!$existingAbsensi) {
                try {
                    $absensi = new AbsensiPetugas([
                        'kelompok_piket_id' => $kelompok->id,
                        'sesi_absensi_id' => $request->sesi_absensi_id,
                        'nama_petugas' => $data['nama_petugas'],
                        'status' => $data['status'],
                        'daftar_hadir' => [],
                    ]);

                    $absensi->created_at = $date;
                    $absensi->updated_at = $date;
                    $absensi->save();

                    $berhasil++;
                } catch (\Exception $e) {
                    $gagal++;
                    $errors[] = "Error pada {$data['nama_petugas']}: " . $e->getMessage();
                }
            } else {
                $gagal++;
                $errors[] = "{$data['nama_petugas']} sudah absen sebelumnya";
            }
        }

        $message = "Absensi bulk: {$berhasil} berhasil";
        if ($gagal > 0) {
            $message .= ", {$gagal} gagal";
        }

        if (!empty($errors)) {
            $message .= ". Detail: " . implode(', ', array_slice($errors, 0, 3));
            if (count($errors) > 3) {
                $message .= " dan " . (count($errors) - 3) . " lainnya";
            }
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Menampilkan laporan absensi
     */
    public function report(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfMonth()->format('Y-m-d'));
        $status = $request->get('status');
        $kelompokId = $request->get('kelompok_id');

        $query = AbsensiPetugas::whereBetween('created_at', [$startDate, $endDate])
            ->with(['kelompok', 'sesi']);

        if ($status) {
            $query->where('status', $status);
        }

        if ($kelompokId) {
            $query->where('kelompok_piket_id', $kelompokId);
        }

        $absensiList = $query->orderBy('created_at', 'desc')->get();
        $statusOptions = AbsensiPetugas::getAvailableStatuses();
        $kelompokOptions = KelompokPiket::orderBy('nama')->get();

        // Summary data
        $summary = [
            'total' => $absensiList->count(),
            'hadir' => $absensiList->where('status', AbsensiPetugas::STATUS_HADIR)->count(),
            'sakit' => $absensiList->where('status', AbsensiPetugas::STATUS_SAKIT)->count(),
            'izin' => $absensiList->where('status', AbsensiPetugas::STATUS_IZIN)->count(),
            'alpha' => $absensiList->where('status', AbsensiPetugas::STATUS_ALPHA)->count(),
        ];

        return view('petugas.absensi.report', compact(
            'absensiList',
            'statusOptions',
            'kelompokOptions',
            'summary',
            'startDate',
            'endDate',
            'status',
            'kelompokId'
        ));
    }
}