@extends('layouts.petugas')

@section('title', 'Absensi Petugas')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Absensi Petugas</h1>
                    <p class="text-gray-600">Kelola absensi petugas piket harian</p>
                </div>
                <nav class="flex items-center space-x-2 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-900">Absensi Petugas</span>
                </nav>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">×</button>
            </div>
        @endif

        @if(session('error') || isset($error))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
                <span>{{ session('error') ?? $error }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">×</button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Form Absensi</h3>

                @if($kelompok)
                    <!-- Kelompok Info -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h4 class="font-medium text-blue-900">Kelompok Piket Hari Ini</h4>
                        <p class="text-lg font-semibold text-blue-800">{{ $kelompok->nama }}</p>
                        <p class="text-sm text-blue-600">{{ date('l, d F Y') }}</p>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('petugas.absensi.store', date('Y-m-d')) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sesi Absensi</label>
                            <select name="sesi_absensi_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Sesi</option>
                                @foreach($sesiList as $sesi)
                                    <option value="{{ $sesi->id }}">
                                        {{ $sesi->nama }} ({{ $sesi->waktu_mulai }} - {{ $sesi->waktu_selesai }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukkan nama petugas" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Kehadiran</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Status</option>
                                @foreach($statusOptions as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-medium">
                            Simpan Absensi
                        </button>
                    </form>
                @else
                    <div class="text-center py-12">
                        <div class="text-yellow-500 text-6xl mb-4">⚠️</div>
                        <h5 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kelompok Piket</h5>
                        <p class="text-gray-500">Silakan tambahkan kelompok piket terlebih dahulu</p>
                    </div>
                @endif
            </div>

            <!-- Attendance List Section -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Absensi Hari Ini</h3>
                    <span class="text-sm text-gray-600">{{ date('l, d F Y') }}</span>
                </div>

                @if($kelompok && isset($absensiHariIni) && $absensiHariIni->count() > 0)
                    <!-- Table -->
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sesi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($absensiHariIni as $index => $absensi)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $absensi->sesi->nama }}</div>
                                            <div class="text-xs text-gray-500">{{ $absensi->sesi->waktu_mulai }} - {{ $absensi->sesi->waktu_selesai }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $absensi->nama_petugas }}</div>
                                            <div class="text-xs text-gray-500">{{ $absensi->kelompok->nama }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            @php
                                                $statusClasses = [
                                                    'hadir' => 'bg-green-100 text-green-800',
                                                    'sakit' => 'bg-yellow-100 text-yellow-800',
                                                    'izin' => 'bg-blue-100 text-blue-800',
                                                    'alpha' => 'bg-red-100 text-red-800'
                                                ];
                                            @endphp
                                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClasses[$absensi->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ $absensi->status_label }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500">
                                            {{ $absensi->created_at->format('H:i:s') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Statistics -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-green-500 rounded-lg p-4 text-white text-center">
                            <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'hadir')->count() }}</div>
                            <div class="text-sm">Hadir</div>
                        </div>
                        <div class="bg-yellow-500 rounded-lg p-4 text-white text-center">
                            <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'sakit')->count() }}</div>
                            <div class="text-sm">Sakit</div>
                        </div>
                        <div class="bg-blue-500 rounded-lg p-4 text-white text-center">
                            <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'izin')->count() }}</div>
                            <div class="text-sm">Izin</div>
                        </div>
                        <div class="bg-red-500 rounded-lg p-4 text-white text-center">
                            <div class="text-2xl font-bold">{{ $absensiHariIni->where('status', 'alpha')->count() }}</div>
                            <div class="text-sm">Alpha</div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">📝</div>
                        <h5 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Absensi Hari Ini</h5>
                        <p class="text-gray-500">Mulai lakukan absensi menggunakan form di sebelah kiri</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection