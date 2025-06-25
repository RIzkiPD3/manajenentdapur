@extends('layouts.angkatan')

@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan aktivitas dan jadwal hari ini')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-slate-800 mb-2">
                Selamat Datang, {{ Auth::user()->name }}
            </h1>
            <p class="text-slate-600">
                Kelola permintaan nampan dan pantau jadwal piket hari ini
            </p>
        </div>
    </div>

    <!-- Today's Schedule Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="bg-slate-800 px-6 py-4 rounded-t-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-calendar-day text-orange-400 mr-3"></i>
                    <h2 class="text-lg font-semibold text-white">Jadwal Hari Ini</h2>
                </div>
                <span class="bg-slate-700 text-slate-300 text-sm px-3 py-1 rounded-full">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>

        <div class="p-6">
            @if ($jadwalHariIni && $jadwalHariIni->kelompok)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Kelompok Bertugas -->
                    <div class="bg-slate-50 rounded-lg p-5 border-l-4 border-orange-400">
                        <div class="flex items-center mb-4">
                            <div class="bg-orange-100 p-3 rounded-lg mr-3">
                                <i class="fa-solid fa-users text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-800">Kelompok Bertugas</h3>
                                <p class="text-xl font-bold text-orange-600">{{ $jadwalHariIni->kelompok->nama_kelompok }}</p>
                            </div>
                        </div>

                        @if($jadwalHariIni->kelompok->anggota && is_array($jadwalHariIni->kelompok->anggota))
                            <div>
                                <p class="text-sm font-medium text-slate-700 mb-3">Anggota Kelompok:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($jadwalHariIni->kelompok->anggota as $anggota)
                                        <span class="bg-orange-100 text-orange-800 text-sm px-3 py-1 rounded-full">
                                            <i class="fa-solid fa-user text-xs mr-1"></i>
                                            {{ $anggota }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Menu Hari Ini -->
                    <div class="bg-slate-50 rounded-lg p-5 border-l-4 border-green-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 p-3 rounded-lg mr-3">
                                <i class="fa-solid fa-utensils text-green-600 text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-slate-800">Menu Hari Ini</h3>
                                @if(isset($menuHariIni) && $menuHariIni->count() > 0)
                                    @foreach($menuHariIni as $menu)
                                        <p class="text-lg font-bold text-green-600">
                                            {{ $menu->nama_menu }}
                                            <span class="text-sm text-slate-500 font-normal">({{ $menu->sesi }})</span>
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-slate-500">Belum ada menu tersedia</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Info -->
                <div class="mt-6 bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fa-solid fa-info-circle text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-slate-800">Status Jadwal</h4>
                            <p class="text-sm text-slate-600">
                                @if($jadwalHariIni->tanggal)
                                    Jadwal sudah ditetapkan untuk {{ \Carbon\Carbon::parse($jadwalHariIni->tanggal)->translatedFormat('d F Y') }}
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
                            <div class="mt-6 bg-slate-50 rounded-lg border border-slate-200">
                                <div class="bg-slate-100 px-4 py-3 rounded-t-lg border-b border-slate-200">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-book-open text-slate-600 mr-2"></i>
                                        <h4 class="font-semibold text-slate-800">Resep: {{ $menu->nama_menu }}</h4>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="bg-white rounded-lg p-4 border border-slate-200">
                                        <p class="whitespace-pre-line text-slate-700 text-sm leading-relaxed">
                                            {{ $menu->resep }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-slate-100 rounded-full p-6 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <i class="fa-solid fa-calendar-xmark text-slate-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Belum Ada Jadwal</h3>
                    <p class="text-slate-600 mb-6 max-w-md mx-auto">
                        @if($totalKelompok == 0)
                            Belum ada kelompok piket yang terdaftar. Silakan hubungi admin untuk membuat kelompok.
                        @else
                            Belum ada jadwal yang ditetapkan untuk hari ini.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Request Nampan Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fa-solid fa-plus text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Request Nampan</h3>
                        <p class="text-sm text-slate-600">Ajukan permintaan nampan</p>
                    </div>
                </div>
                <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                    Buat permintaan nampan tambahan untuk kebutuhan makan di asrama dengan mudah dan cepat.
                </p>
                <a href="{{ route('angkatan.request-nampan.create') }}"
                   class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2.5 rounded-lg transition-colors duration-200 w-full justify-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Buat Permintaan
                </a>
            </div>
        </div>

        <!-- History Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fa-solid fa-history text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Riwayat Permintaan</h3>
                        <p class="text-sm text-slate-600">Lihat status permintaan</p>
                    </div>
                </div>
                <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                    Pantau status dan riwayat semua permintaan nampan yang telah Anda ajukan sebelumnya.
                </p>
                <a href="{{ route('angkatan.riwayat-request') }}"
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2.5 rounded-lg transition-colors duration-200 w-full justify-center">
                    <i class="fa-solid fa-history mr-2"></i>
                    Lihat Riwayat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection