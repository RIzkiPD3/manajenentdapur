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
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'status_aktif' => 'nullable'
        ]);

        try {
            // Simpan ke database
            User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'angkatan',
                'status_aktif' => $request->has('status_aktif') ? 1 : 0,
            ]);

            // Redirect ke dashboard admin
            return redirect()->route('admin.dashboard')->with('success', 'Akun angkatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating angkatan account: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal menambahkan akun angkatan.'])->withInput();
        }
    }

    public function show(string $id)
    {
        $angkatan = User::where('role', 'angkatan')->findOrFail($id);
        return view('admin.angkatan.show', compact('angkatan'));
    }

    public function edit(string $id)
    {
        $angkatan = User::where('role', 'angkatan')->findOrFail($id);
        return view('admin.angkatan.edit', compact('angkatan'));
    }

    public function update(Request $request, string $id)
    {
        $angkatan = User::where('role', 'angkatan')->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $angkatan->id,
            'password' => 'nullable|string|min:6|confirmed',
            'status_aktif' => 'nullable|boolean'
        ]);

        try {
            $angkatan->name = $request->nama;
            $angkatan->email = $request->email;
            $angkatan->status_aktif = $request->has('status_aktif') ? 1 : 0;

            if ($request->filled('password')) {
                $angkatan->password = Hash::make($request->password);
            }

            $angkatan->save();

            return redirect()->route('admin.angkatan.index')->with('success', 'Akun angkatan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating angkatan account: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal memperbarui akun angkatan.']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $angkatan = User::where('role', 'angkatan')->findOrFail($id);
            $angkatan->delete();

            return redirect()->route('admin.angkatan.index')->with('success', 'Akun angkatan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting angkatan account: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal menghapus akun angkatan.']);
        }
    }

    // ======== LOGIN LOGIKA UNTUK ANGKATAN ========

    public function showLoginForm()
    {
        return view('angkatan.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $user = User::where('email', $request->email)->where('role', 'angkatan')->first();

            if (!$user) {
                return back()->withErrors(['email' => 'Akun tidak ditemukan.'])->withInput();
            }

            if (!$user->status_aktif) {
                return back()->withErrors(['email' => 'Akun angkatan tidak aktif.'])->withInput();
            }

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Log::info('Angkatan login successful: ' . $user->email);
                return redirect()->route('angkatan.dashboard')->with('success', 'Login berhasil!');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();

        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat login.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('angkatan.login')->with('success', 'Logout berhasil.');
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            return redirect()->route('angkatan.login');
        }
    }
}