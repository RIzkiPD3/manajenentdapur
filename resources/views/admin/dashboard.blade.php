@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Dashboard Admin</h1>
            <p class="text-slate-600">Kelola sistem jadwal makanan dengan mudah</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Angkatan Card -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-orange-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-slate-800">{{ $totalAngkatan }}</p>
                            <p class="text-sm text-slate-500">Total Angkatan</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.angkatan.create') }}" class="inline-flex items-center text-sm text-orange-500 hover:text-orange-600 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Angkatan
                    </a>
                </div>
            </div>

            <!-- Total Kelompok Card -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-slate-800">{{ $totalKelompok }}</p>
                            <p class="text-sm text-slate-500">Total Kelompok</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600">Kelompok aktif</p>
                </div>
            </div>

            <!-- Total Menu Card -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-slate-800">{{ $totalMenu }}</p>
                            <p class="text-sm text-slate-500">Total Menu</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600">Menu tersedia</p>
                </div>
            </div>

            <!-- Kelompok Bertugas Hari Ini Card -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-slate-800">
                                @if($jadwalHariIni && $jadwalHariIni->kelompok)
                                    {{ $jadwalHariIni->kelompok->nama_kelompok }}
                                @else
                                    -
                                @endif
                            </p>
                            <p class="text-sm text-slate-500">Kelompok Bertugas</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600">Hari ini</p>
                </div>
            </div>
        </div>

        <!-- Today's Schedule Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-slate-800 px-6 py-4 rounded-t-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-white">Jadwal Hari Ini</h3>
                    </div>
                    <span class="bg-slate-700 text-white text-sm px-3 py-1 rounded-full">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                @if ($jadwalHariIni && $jadwalHariIni->kelompok)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kelompok Bertugas -->
                        <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-orange-500">
                            <div class="flex items-center mb-3">
                                <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Kelompok Bertugas</h4>
                                    <p class="text-lg font-semibold text-orange-500">{{ $jadwalHariIni->kelompok->nama_kelompok }}</p>
                                </div>
                            </div>
                            <!-- Anggota Kelompok -->
                            @if($jadwalHariIni->kelompok->anggota && is_array($jadwalHariIni->kelompok->anggota))
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-slate-700 mb-2">Anggota:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($jadwalHariIni->kelompok->anggota as $anggota)
                                            <span class="bg-orange-100 text-orange-600 text-xs px-2 py-1 rounded-full">
                                                {{ $anggota }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Menu Hari Ini -->
                        <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-400">
                            <div class="flex items-center mb-3">
                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-800">Menu Hari Ini</h4>
                                    @if(isset($menuHariIni) && $menuHariIni->count() > 0)
                                        @foreach($menuHariIni as $menu)
                                            <p class="text-sm font-semibold text-green-400">
                                                {{ $menu->nama_menu }}
                                                <span class="text-xs text-slate-500">({{ $menu->sesi }})</span>
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-slate-500">Belum ada menu</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Jadwal -->
                    <div class="mt-6 bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <div class="flex items-center">
                            <div class="bg-slate-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-slate-800">Status Jadwal</h4>
                                <p class="text-sm text-slate-600">
                                    @if($jadwalHariIni->tanggal)
                                        Jadwal sudah di-generate untuk tanggal {{ \Carbon\Carbon::parse($jadwalHariIni->tanggal)->translatedFormat('d F Y') }}
                                    @else
                                        Menggunakan jadwal template ({{ $jadwalHariIni->hari }})
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Section -->
                    @if(isset($menuHariIni) && $menuHariIni->count() > 0)
                        @foreach($menuHariIni as $menu)
                            @if($menu->resep)
                                <div class="mt-6 bg-cyan-50 rounded-lg p-4 border border-cyan-200">
                                    <div class="flex items-center mb-3">
                                        <div class="bg-cyan-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="font-medium text-slate-800">Resep: {{ $menu->nama_menu }}</h4>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <p class="whitespace-pre-line text-slate-700 text-sm leading-relaxed">
                                            {{ $menu->resep }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="bg-slate-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-medium text-slate-800 mb-2">Belum Ada Jadwal</h4>
                        <p class="text-slate-500 mb-4">
                            @if($totalKelompok == 0)
                                Belum ada kelompok piket yang terdaftar. Silakan buat kelompok terlebih dahulu.
                            @else
                                Belum ada jadwal yang ditetapkan untuk hari ini.
                            @endif
                        </p>
                        <div class="flex gap-2 justify-center">
                            @if($totalKelompok == 0)
                                <a href="{{ route('admin.kelompok.create') }}" class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                    Buat Kelompok
                                </a>
                            @endif
                            <a href="{{ route('admin.jadwal.create') }}" class="bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                Tambah Jadwal
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection