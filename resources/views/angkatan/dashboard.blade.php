@extends('layouts.angkatan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    Dashboard Angkatan
                </h1>
                <p class="text-gray-600">
                    Selamat datang kembali, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Today's Schedule Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="bg-blue-600 px-6 py-4 rounded-t-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Jadwal Hari Ini</h3>
                </div>
                <span class="bg-blue-500 text-white text-sm px-3 py-1 rounded-full">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>

        <div class="p-6">
            @if ($jadwalHariIni && $jadwalHariIni->kelompok)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kelompok Bertugas -->
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-blue-500">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Kelompok Bertugas</h4>
                                <p class="text-lg font-semibold text-blue-600">{{ $jadwalHariIni->kelompok->nama_kelompok }}</p>
                            </div>
                        </div>
                        <!-- Anggota Kelompok -->
                        @if($jadwalHariIni->kelompok->anggota && is_array($jadwalHariIni->kelompok->anggota))
                            <div class="mt-3">
                                <p class="text-sm font-medium text-gray-700 mb-2">Anggota:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($jadwalHariIni->kelompok->anggota as $anggota)
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                            {{ $anggota }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Menu Hari Ini -->
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-500">
                        <div class="flex items-center mb-3">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Menu Hari Ini</h4>
                                @if(isset($menuHariIni) && $menuHariIni->count() > 0)
                                    @foreach($menuHariIni as $menu)
                                        <p class="text-sm font-semibold text-green-600">
                                            {{ $menu->nama_menu }}
                                            <span class="text-xs text-gray-500">({{ $menu->sesi }})</span>
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500">Belum ada menu</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Jadwal -->
                <div class="mt-6 bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Status Jadwal</h4>
                            <p class="text-sm text-gray-600">
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
                            <div class="mt-6 bg-orange-50 rounded-lg p-4 border border-orange-200">
                                <div class="flex items-center mb-3">
                                    <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-medium text-gray-900">Resep: {{ $menu->nama_menu }}</h4>
                                </div>
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <p class="whitespace-pre-line text-gray-700 text-sm leading-relaxed">
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
                    <div class="bg-gray-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Jadwal</h4>
                    <p class="text-gray-500 mb-4">
                        @if($totalKelompok == 0)
                            Belum ada kelompok piket yang terdaftar. Silakan buat kelompok terlebih dahulu.
                        @else
                            Belum ada jadwal yang ditetapkan untuk hari ini.
                        @endif
                    </p>
                    <div class="flex gap-2 justify-center">
                        @if($totalKelompok == 0)
                            <a href="{{ route('admin.kelompok.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                Buat Kelompok
                            </a>
                        @endif
                        <a href="{{ route('admin.jadwal.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                            Tambah Jadwal
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8">
        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <!-- Request Nampan Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Permintaan Nampan</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm">
                        Ajukan permintaan nampan tambahan untuk kebutuhan makan di asrama
                    </p>
                    <a href="{{ route('angkatan.request-nampan.create') }}"
                       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                        Buat Permintaan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- History Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Riwayat Permintaan</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm">
                        Lihat status dan riwayat semua permintaan nampan yang telah diajukan
                    </p>
                    <a href="{{ route('angkatan.riwayat-request') }}"
                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                        Lihat Riwayat
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection