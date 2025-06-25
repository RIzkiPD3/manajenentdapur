@extends('layouts.petugas')

@section('title', 'Absensi Petugas')
@section('page-title', 'Absensi Petugas')
@section('page-description', 'Kelola absensi petugas piket harian')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fa-solid fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error') || isset($error))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fa-solid fa-exclamation-circle mr-2"></i>
                <span>{{ session('error') ?? $error }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-clipboard-check text-white"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Form Absensi</h3>
                    <p class="text-sm text-slate-600">Input data kehadiran petugas</p>
                </div>
            </div>

            @if($kelompok)
                <!-- Kelompok Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-users text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-blue-900">{{ $kelompok->nama }}</h4>
                            <p class="text-sm text-blue-600">{{ date('l, d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('petugas.absensi.store', date('Y-m-d')) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fa-solid fa-clock mr-1 text-slate-500"></i>
                            Sesi Absensi
                        </label>
                        <select name="sesi_absensi_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                            <option value="">Pilih Sesi</option>
                            @foreach($sesiList as $sesi)
                                <option value="{{ $sesi->id }}">
                                    {{ $sesi->nama }} ({{ $sesi->waktu_mulai }} - {{ $sesi->waktu_selesai }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fa-solid fa-user mr-1 text-slate-500"></i>
                            Nama Petugas
                        </label>
                        <input type="text" name="nama_petugas"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Masukkan nama petugas" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fa-solid fa-check-circle mr-1 text-slate-500"></i>
                            Status Kehadiran
                        </label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                            <option value="">Pilih Status</option>
                            @foreach($statusOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-save"></i>
                        <span>Simpan Absensi</span>
                    </button>
                </form>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-exclamation-triangle text-yellow-600 text-2xl"></i>
                    </div>
                    <h5 class="text-lg font-semibold text-slate-800 mb-2">Belum Ada Kelompok Piket</h5>
                    <p class="text-slate-600">Silakan tambahkan kelompok piket terlebih dahulu</p>
                </div>
            @endif
        </div>

        <!-- Attendance List Section -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-list-check text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Absensi Hari Ini</h3>
                        <p class="text-sm text-slate-600">{{ date('l, d F Y') }}</p>
                    </div>
                </div>
                <div class="bg-slate-100 px-3 py-2 rounded-lg">
                    <span class="text-sm font-medium text-slate-700">Total: {{ isset($absensiHariIni) ? $absensiHariIni->count() : 0 }}</span>
                </div>
            </div>

            @if($kelompok && isset($absensiHariIni) && $absensiHariIni->count() > 0)
                <!-- Table -->
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Sesi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($absensiHariIni as $index => $absensi)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-4 text-sm font-medium text-slate-900">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $absensi->sesi->nama }}</div>
                                        <div class="text-xs text-slate-500">{{ $absensi->sesi->waktu_mulai }} - {{ $absensi->sesi->waktu_selesai }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $absensi->nama_petugas }}</div>
                                        <div class="text-xs text-slate-500">{{ $absensi->kelompok->nama }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        @php
                                            $statusClasses = [
                                                'hadir' => 'bg-green-100 text-green-800 border-green-200',
                                                'sakit' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'izin' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'alpha' => 'bg-red-100 text-red-800 border-red-200'
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full border {{ $statusClasses[$absensi->status] ?? 'bg-slate-100 text-slate-800 border-slate-200' }}">
                                            {{ $absensi->status_label }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-slate-600">
                                        {{ $absensi->created_at->format('H:i:s') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-green-500 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'hadir')->count() }}</div>
                                <div class="text-sm text-green-100">Hadir</div>
                            </div>
                            <i class="fa-solid fa-check text-green-200 text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-yellow-500 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'sakit')->count() }}</div>
                                <div class="text-sm text-yellow-100">Sakit</div>
                            </div>
                            <i class="fa-solid fa-thermometer text-yellow-200 text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-blue-500 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'izin')->count() }}</div>
                                <div class="text-sm text-blue-100">Izin</div>
                            </div>
                            <i class="fa-solid fa-calendar-check text-blue-200 text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-red-500 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'alpha')->count() }}</div>
                                <div class="text-sm text-red-100">Alpha</div>
                            </div>
                            <i class="fa-solid fa-times text-red-200 text-xl"></i>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-clipboard-list text-slate-400 text-2xl"></i>
                    </div>
                    <h5 class="text-lg font-semibold text-slate-800 mb-2">Belum Ada Absensi Hari Ini</h5>
                    <p class="text-slate-600">Mulai lakukan absensi menggunakan form di sebelah kiri</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection