<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\JadwalPiketController;
use App\Http\Controllers\KelompokPiketController;
use App\Models\Menu;
use App\Models\KelompokPiket;
use App\Models\JadwalPiket;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Password;

class AngkatanController extends Controller
{
    public function index()
    {
        // Inisialisasi semua variabel dengan nilai default yang aman
        $angkatan = auth()->user()->angkatan ?? '';
        $jadwalHariIni = null;
        $menuHariIni = collect([]);
        $totalKelompok = 0;
        $pesanKelompok = 'Tidak ada jadwal piket untuk hari ini';

        try {
            // Ambil total kelompok dengan error handling
            try {
                $totalKelompok = KelompokPiket::count();
            } catch (\Exception $e) {
                Log::warning('Error getting total kelompok: ' . $e->getMessage());
                $totalKelompok = 0;
            }

            // Ambil jadwal hari ini dengan error handling
            try {
                $jadwalHariIni = JadwalPiketController::getJadwalHariIni();

                if (!$jadwalHariIni) {
                    Log::info('No jadwal found for today');
                }
            } catch (\Exception $e) {
                Log::warning('Error getting jadwal hari ini: ' . $e->getMessage());
                $jadwalHariIni = null;
            }

            // Ambil menu hari ini dengan error handling
            try {
                $menuHariIni = Menu::whereDate('tanggal', Carbon::today())
                    ->orderBy('sesi', 'asc')
                    ->get();

                if (!$menuHariIni) {
                    $menuHariIni = collect([]);
                }
            } catch (\Exception $e) {
                Log::warning('Error getting menu hari ini: ' . $e->getMessage());
                $menuHariIni = collect([]);
            }

            // Set pesan kelompok berdasarkan kondisi
            if ($jadwalHariIni && $jadwalHariIni->kelompok) {
                $pesanKelompok = null;
            } else {
                if ($totalKelompok == 0) {
                    $pesanKelompok = 'Belum ada kelompok piket yang terdaftar';
                } else {
                    $pesanKelompok = 'Tidak ada jadwal piket untuk hari ini';
                }
            }

        } catch (\Exception $e) {
            Log::error('Error in AngkatanController index: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            // Pastikan semua variabel tetap ada meskipun error
            // Variabel sudah diinisialisasi di atas dengan nilai default
        }

        // Pastikan semua variabel yang dibutuhkan view ada
        $dataToView = [
            'angkatan' => $angkatan,
            'jadwalHariIni' => $jadwalHariIni,
            'menuHariIni' => $menuHariIni,
            'pesanKelompok' => $pesanKelompok,
            'totalKelompok' => $totalKelompok
        ];

        // Log untuk debugging
        Log::info('Data sent to view:', [
            'jadwalHariIni_exists' => !is_null($jadwalHariIni),
            'menuHariIni_count' => $menuHariIni->count(),
            'totalKelompok' => $totalKelompok
        ]);

        return view('angkatan.dashboard', $dataToView);
    }

    public function create()
    {
        return view('admin.angkatan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(6)],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        try {
            // Buat user baru dengan role angkatan
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'angkatan', // Set role sebagai angkatan
            ]);

            // Redirect ke dashboard admin dengan pesan sukses
            return redirect()->route('admin.dashboard')
                ->with('success', 'Akun angkatan berhasil dibuat untuk ' . $user->name);

        } catch (\Exception $e) {
            Log::error('Error creating angkatan account: ' . $e->getMessage());

            // Jika terjadi error, kembalikan ke form dengan pesan error
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Gagal membuat akun angkatan. Silakan coba lagi.');
        }
    }
}