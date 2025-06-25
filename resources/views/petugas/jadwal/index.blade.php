@extends('layouts.petugas')

@section('title', 'Jadwal Piket')
@section('page-title', 'Jadwal Piket')
@section('page-description', 'Lihat jadwal piket hari ini')

@section('content')
<div class="max-w-6xl mx-auto">
    @if(session('message'))
        <!-- No Schedule Message -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-exclamation-triangle text-orange-500 text-2xl"></i>
            </div>
            <h2 class="text-xl font-semibold text-slate-800 mb-2">Tidak Ada Jadwal</h2>
            <p class="text-slate-600">{{ $message }}</p>
        </div>
    @else
        <!-- Jadwal Piket & Menu Combined Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-6 rounded-t-lg">
                <div class="flex items-center space-x-4">
                    <div>
                        <h2 class="text-xl font-semibold text-white">Jadwal Piket & Menu Hari Ini</h2>
                        <p class="text-blue-100 text-sm flex items-center">
                            <i class="fa-solid fa-calendar-day mr-2"></i>
                            {{ $hari }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Kelompok Piket Section -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white rounded-lg shadow-sm border border-gray-200 flex items-center justify-center">
                                <i class="fa-solid fa-users text-blue-500 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">{{ $kelompok->nama_kelompok ?? 'Tidak Ada Kelompok' }}</h3>
                                <p class="text-sm text-slate-600">Kelompok Piket Hari Ini</p>
                            </div>
                        </div>
                    </div>

                    @if($kelompok && $kelompok->anggota)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @forelse ($kelompok->anggota as $index => $anggota)
                                <div class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition-colors">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-semibold text-sm">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-slate-900 font-medium">{{ $anggota }}</p>
                                        <p class="text-xs text-slate-500">Anggota Kelompok</p>
                                    </div>
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-6">
                                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fa-solid fa-user-plus text-slate-400 text-lg"></i>
                                    </div>
                                    <h4 class="text-md font-semibold text-slate-700 mb-1">Belum Ada Anggota</h4>
                                    <p class="text-sm text-slate-500">Belum ada anggota yang terdaftar dalam kelompok ini.</p>
                                </div>
                            @endforelse
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-user-plus text-slate-400 text-lg"></i>
                            </div>
                            <h4 class="text-md font-semibold text-slate-700 mb-1">Belum Ada Anggota</h4>
                            <p class="text-sm text-slate-500">Belum ada anggota yang terdaftar dalam kelompok ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-6"></div>

                <!-- Menu Hari Ini Section -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-white rounded-lg shadow-sm border border-gray-200 flex items-center justify-center">
                            <i class="fa-solid fa-utensils text-orange-500 text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800">Menu Hari Ini</h3>
                            <p class="text-sm text-slate-600">Daftar Menu yang Tersedia</p>
                        </div>
                    </div>

                    @if($menuHariIni && $menuHariIni->count() > 0)
                        <div class="space-y-3">
                            @foreach($menuHariIni as $menu)
                                <div class="flex items-center p-4 bg-orange-50 hover:bg-orange-100 rounded-lg border border-orange-200 transition-colors">
                                    <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                                        <i class="fa-solid fa-bowl-food text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-slate-900">{{ $menu->nama_menu }}</h4>
                                        <p class="text-sm text-slate-600 flex items-center">
                                            <i class="fa-solid fa-clock mr-1"></i>
                                            {{ ucfirst($menu->sesi) }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        @php
                                            $sesiColors = [
                                                'sarapan' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                'makan siang' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                'makan malam' => 'bg-purple-100 text-purple-700 border-purple-200'
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $sesiColors[strtolower($menu->sesi)] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                            {{ ucfirst($menu->sesi) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-plate-wheat text-slate-400 text-lg"></i>
                            </div>
                            <h4 class="text-md font-semibold text-slate-700 mb-1">Belum Ada Menu</h4>
                            <p class="text-sm text-slate-500">Belum ada menu yang diatur untuk hari ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-slate-50 px-6 py-4 rounded-b-lg border-t border-slate-200">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center text-slate-600">
                        <i class="fa-solid fa-clock mr-2"></i>
                        <span>Diperbarui: {{ now()->format('d M Y, H:i') }}</span>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 border border-blue-200">
                        <i class="fa-solid fa-circle text-blue-500 mr-1 text-xs"></i>
                        Aktif
                    </span>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection