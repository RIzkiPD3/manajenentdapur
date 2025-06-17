<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AngkatanController extends Controller
{
    public function index()
    {
        $angkatans = User::where('role', 'angkatan')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.angkatan.index', compact('angkatans'));
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

        // Simpan ke database
        User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'angkatan',
            // 'status_aktif' => $request->has('status_aktif') ? 1 : 0, // ← HAPUS baris ini
        ]);

        // Redirect ke dashboard admin
        return redirect()->route('admin.dashboard')->with('success', 'Akun angkatan berhasil ditambahkan.');
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

        $angkatan->name = $request->nama;
        $angkatan->email = $request->email;
        $angkatan->status_aktif = $request->has('status_aktif') ? 1 : 0;

        if ($request->filled('password')) {
            $angkatan->password = Hash::make($request->password);
        }

        $angkatan->save();

        return redirect()->route('admin.angkatan.index')->with('success', 'Akun angkatan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $angkatan = User::where('role', 'angkatan')->findOrFail($id);
        $angkatan->delete();

        return redirect()->route('admin.angkatan.index')->with('success', 'Akun angkatan berhasil dihapus.');
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

        $user = User::where('email', $request->email)->where('role', 'angkatan')->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.'])->withInput();
        }

        if (!$user->status_aktif) {
            return back()->withErrors(['email' => 'Akun angkatan tidak aktif.'])->withInput();
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('angkatan.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('angkatan.login')->with('success', 'Logout berhasil.');
    }
}
