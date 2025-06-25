@extends('layouts.petugas')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-slate-800 mb-2">Dashboard Petugas</h1>
            <p class="text-xl text-slate-600">Selamat datang, <span class="font-semibold text-orange-500">{{ Auth::user()->name }}</span>!</p>
            <p class="text-sm text-slate-500 mt-1">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Menu Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Total Menu</p>
                        <p class="text-3xl font-bold text-slate-800">{{ \App\Models\Menu::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Kelompok Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Total Kelompok</p>
                        <p class="text-3xl font-bold text-slate-800">{{ \App\Models\KelompokPiket::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Jadwal Hari Ini Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Jadwal Hari Ini</p>
                        @php
                            // Gunakan method dari controller untuk konsistensi
                            $jadwalHariIni = \App\Http\Controllers\JadwalPiketController::getJadwalHariIni();
                        @endphp
                        @if($jadwalHariIni && $jadwalHariIni->kelompok)
                            <p class="text-lg font-bold text-slate-800">{{ $jadwalHariIni->kelompok->nama_kelompok }}</p>
                        @else
                            <p class="text-lg font-bold text-slate-400">Tidak ada jadwal</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Info Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Jadwal Piket Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-800">Jadwal Piket Minggu Ini</h3>
                    <a href="{{ route('petugas.jadwal') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium transition-colors">
                        Lihat Semua →
                    </a>
                </div>

                @php
                    // Gunakan method dari controller untuk konsistensi
                    $jadwalMingguIni = \App\Http\Controllers\JadwalPiketController::getJadwalMingguIni();

                    // Ambil hari saat ini untuk highlighting
                    $hariMapping = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu'
                    ];
                    $hariIni = $hariMapping[\Carbon\Carbon::now()->format('l')];
                @endphp

                <div class="space-y-3">
                    @forelse($jadwalMingguIni as $jadwal)
                        <div class="flex items-center justify-between p-3 rounded-lg {{ $jadwal && $jadwal->hari == $hariIni ? 'bg-orange-50 border border-orange-200' : 'bg-slate-50' }}">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 rounded-full {{ $jadwal && $jadwal->hari == $hariIni ? 'bg-orange-500' : 'bg-slate-400' }}"></div>
                                <span class="font-medium {{ $jadwal && $jadwal->hari == $hariIni ? 'text-orange-800' : 'text-slate-700' }}">
                                    {{ $jadwal ? $jadwal->hari : 'N/A' }}
                                </span>
                            </div>
                            <span class="text-sm {{ $jadwal && $jadwal->hari == $hariIni ? 'text-orange-700 font-semibold' : 'text-slate-600' }}">
                                {{ $jadwal && $jadwal->kelompok ? $jadwal->kelompok->nama_kelompok : 'Tidak ada jadwal' }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-slate-500">Belum ada jadwal piket yang tersedia</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Kelompok Piket Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-800">Kelompok Piket</h3>
                    <span class="text-sm text-slate-500">{{ \App\Models\KelompokPiket::count() }} kelompok</span>
                </div>

                @php
                    $kelompokList = \App\Models\KelompokPiket::latest()->take(5)->get();
                @endphp

                <div class="space-y-3">
                    @forelse($kelompokList as $kelompok)
                        <div class="p-3 bg-slate-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-slate-800">{{ $kelompok->nama_kelompok }}</h4>
                                <span class="text-xs bg-slate-200 text-slate-700 px-2 py-1 rounded-full">
                                    {{ count($kelompok->anggota) }} anggota
                                </span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm text-slate-600">
                                    {{ implode(', ', array_slice($kelompok->anggota, 0, 3)) }}
                                    @if(count($kelompok->anggota) > 3)
                                        <span class="text-slate-400">dan {{ count($kelompok->anggota) - 3 }} lainnya</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-slate-500">Belum ada kelompok piket yang tersedia</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('petugas.jadwal') }}" class="bg-white p-4 rounded-lg border border-slate-200 hover:shadow-md hover:border-orange-300 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800">Lihat Jadwal</p>
                            <p class="text-sm text-slate-500">Cek jadwal piket lengkap</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('petugas.nampan.index') }}" class="bg-white p-4 rounded-lg border border-slate-200 hover:shadow-md hover:border-green-300 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800">Request Nampan</p>
                            <p class="text-sm text-slate-500">Kelola permintaan nampan</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('petugas.nampan.riwayat') }}" class="bg-white p-4 rounded-lg border border-slate-200 hover:shadow-md hover:border-purple-300 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800">Riwayat Nampan</p>
                            <p class="text-sm text-slate-500">Lihat riwayat permintaan</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection