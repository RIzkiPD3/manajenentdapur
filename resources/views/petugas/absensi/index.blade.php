@extends('layouts.petugas')

@section('title', 'Absensi Petugas')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Main Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-4 rounded-t-lg">
                <h4 class="text-xl font-semibold">Absensi Petugas - {{ date('d/m/Y') }}</h4>
            </div>

            <div class="p-6">
                <!-- Success Alert -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Error Alert -->
                @if(session('error') || isset($error))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            {{ session('error') ?? $error }}
                        </div>
                        <button type="button" class="text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Group Info -->
                @if($kelompok)
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h5 class="text-lg font-semibold text-blue-800 mb-1">Kelompok Piket Hari Ini</h5>
                                <p class="text-blue-800 font-medium mb-1">{{ $kelompok->nama }}</p>
                                <p class="text-blue-700 text-sm">Anggota: {{ is_array($kelompok->anggota) ? implode(', ', $kelompok->anggota) : $kelompok->anggota }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h5 class="text-lg font-semibold text-yellow-800 mb-1">Tidak Ada Kelompok Piket</h5>
                                <p class="text-yellow-700 text-sm">Belum ada kelompok piket yang terdaftar. Hubungi administrator untuk menambahkan kelompok piket.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Attendance Form -->
                @if($kelompok && $sesiList->count() > 0)
                    <form action="{{ route('petugas.absensi.store', date('Y-m-d')) }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Session Selection -->
                        <div>
                            <label for="sesi_absensi_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Sesi Absensi
                            </label>
                            <select name="sesi_absensi_id" id="sesi_absensi_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sesi_absensi_id') border-red-500 @enderror"
                                    required>
                                <option value="">-- Pilih Sesi --</option>
                                @foreach($sesiList as $sesi)
                                    <option value="{{ $sesi->id }}" {{ old('sesi_absensi_id') == $sesi->id ? 'selected' : '' }}>
                                        {{ $sesi->nama }} ({{ date('H:i', strtotime($sesi->waktu_mulai)) }} - {{ date('H:i', strtotime($sesi->waktu_selesai)) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('sesi_absensi_id')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('sesi_absensi_id') }}</p>
                            @enderror
                        </div>

                        <!-- Attendance List -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Daftar Hadir</label>
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                @php
                                    $anggotaList = is_array($kelompok->anggota) ? $kelompok->anggota : explode(',', $kelompok->anggota ?? '');
                                @endphp
                                @if($anggotaList && count($anggotaList) > 0)
                                    <div class="space-y-3">
                                        @foreach($anggotaList as $index => $anggota)
                                            @php $anggota = trim($anggota); @endphp
                                            @if($anggota)
                                                <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition-colors">
                                                    <input type="checkbox"
                                                           name="daftar_hadir[]"
                                                           value="{{ $anggota }}"
                                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                                           {{ in_array($anggota, old('daftar_hadir', [])) ? 'checked' : '' }}>
                                                    <span class="ml-3 text-sm font-medium text-gray-700">{{ $anggota }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-4">Tidak ada anggota dalam kelompok ini.</p>
                                @endif
                            </div>
                            <p class="mt-2 text-sm text-gray-600">Centang nama petugas yang hadir</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit"
                                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Simpan Absensi
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-600">
                            @if(!$kelompok)
                                Form absensi tidak dapat ditampilkan karena belum ada kelompok piket.
                            @elseif($sesiList->count() == 0)
                                Form absensi tidak dapat ditampilkan karena belum ada sesi absensi yang dikonfigurasi.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Today's Attendance History -->
        @if($kelompok)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 mt-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                    <h5 class="text-lg font-semibold text-gray-800">Riwayat Absensi Hari Ini</h5>
                </div>
                <div class="p-6">
                    @php
                        $absensiHariIni = \App\Models\AbsensiPetugas::where('tanggal', date('Y-m-d'))
                            ->where('kelompok_piket_id', $kelompok->id)
                            ->with('sesiAbsensi')
                            ->orderBy('created_at', 'desc')
                            ->get();
                    @endphp

                    @if($absensiHariIni->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Sesi</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Waktu</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Hadir</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Dicatat</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($absensiHariIni as $absensi)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4 text-sm font-medium text-gray-900">
                                                {{ $absensi->sesiAbsensi->nama }}
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-700">
                                                {{ date('H:i', strtotime($absensi->sesiAbsensi->waktu_mulai)) }} -
                                                {{ date('H:i', strtotime($absensi->sesiAbsensi->waktu_selesai)) }}
                                            </td>
                                            <td class="py-3 px-4">
                                                @if($absensi->daftar_hadir && count($absensi->daftar_hadir) > 0)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ count($absensi->daftar_hadir) }} orang
                                                    </span>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        {{ implode(', ', $absensi->daftar_hadir) }}
                                                    </div>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Tidak ada yang hadir
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-700">
                                                {{ $absensi->created_at->format('H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <p class="text-gray-500">Belum ada absensi yang tercatat hari ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection