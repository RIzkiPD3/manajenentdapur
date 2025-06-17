@extends('layouts.petugas')

@section('title', 'Absensi Tanggal ' . \Carbon\Carbon::parse($tanggal)->format('d F Y'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 mb-8">
            <div class="p-6 border-b border-gray-200/50">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-calendar-check text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">
                                Absensi Tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                            </h1>
                            @if($kelompokHari)
                                <p class="text-sm text-gray-600 mt-1">{{ $kelompokHari->nama }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('petugas.absensi.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="button"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg"
                                data-toggle="modal" data-target="#addAbsensiModal">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Absensi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mx-6 mt-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-r-lg" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <p class="text-green-700">{{ session('success') }}</p>
                        <button type="button" class="ml-auto text-green-400 hover:text-green-600" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-6 mt-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-r-lg" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-400 mr-3"></i>
                        <p class="text-red-700">{{ session('error') }}</p>
                        <button type="button" class="ml-auto text-red-400 hover:text-red-600" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-calendar text-xl"></i>
                            </div>
                            <div>
                                <p class="text-blue-100 text-sm">Tanggal</p>
                                <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div>
                                <p class="text-green-100 text-sm">Total Absensi</p>
                                <p class="text-xl font-bold">{{ $absensiList->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Table -->
                @if($absensiList->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-900 text-white">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">#</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Nama Petugas</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Sesi</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Waktu Sesi</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Kelompok</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Waktu Absen</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Daftar Hadir</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($absensiList as $index => $absensi)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4">
                                                <div class="font-semibold text-gray-900">{{ $absensi->nama_petugas }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-700">{{ $absensi->sesi->nama ?? '-' }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                @if($absensi->sesi)
                                                    {{ $absensi->sesi->waktu_mulai }} - {{ $absensi->sesi->waktu_selesai }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @switch($absensi->status)
                                                    @case('hadir')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check mr-1"></i> Hadir
                                                        </span>
                                                        @break
                                                    @case('sakit')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            <i class="fas fa-thermometer-half mr-1"></i> Sakit
                                                        </span>
                                                        @break
                                                    @case('izin')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            <i class="fas fa-calendar-times mr-1"></i> Izin
                                                        </span>
                                                        @break
                                                    @case('alpha')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            <i class="fas fa-times mr-1"></i> Alpha
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ ucfirst($absensi->status) }}</span>
                                                @endswitch
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-700">{{ $absensi->kelompok->nama ?? '-' }}</td>
                                            <td class="px-6 py-4 text-xs text-gray-500">
                                                {{ $absensi->created_at->format('H:i:s') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($absensi->daftar_hadir && count($absensi->daftar_hadir) > 0)
                                                    <button type="button"
                                                            class="inline-flex items-center px-3 py-1 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg text-xs transition-colors duration-200"
                                                            data-toggle="popover"
                                                            data-content="{{ implode(', ', $absensi->daftar_hadir) }}"
                                                            data-trigger="hover"
                                                            title="Daftar Hadir">
                                                        <i class="fas fa-list mr-2"></i>
                                                        {{ count($absensi->daftar_hadir) }} orang
                                                    </button>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Summary Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-check text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-green-100 text-sm">Hadir</p>
                                    <p class="text-2xl font-bold">{{ $absensiList->where('status', 'hadir')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-6 text-white shadow-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-thermometer-half text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-yellow-100 text-sm">Sakit</p>
                                    <p class="text-2xl font-bold">{{ $absensiList->where('status', 'sakit')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-calendar-times text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-blue-100 text-sm">Izin</p>
                                    <p class="text-2xl font-bold">{{ $absensiList->where('status', 'izin')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl p-6 text-white shadow-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-times text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-red-100 text-sm">Alpha</p>
                                    <p class="text-2xl font-bold">{{ $absensiList->where('status', 'alpha')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-calendar-times text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Absensi</h3>
                        <p class="text-gray-500 mb-8">Belum ada data absensi untuk tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>
                        <button type="button"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg"
                                data-toggle="modal" data-target="#addAbsensiModal">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Absensi Pertama
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Absensi -->
<div class="modal fade" id="addAbsensiModal" tabindex="-1" role="dialog" aria-labelledby="addAbsensiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-2xl border-0 shadow-2xl">
            <div class="modal-header border-b border-gray-200 p-6">
                <h5 class="modal-title text-xl font-bold text-gray-900 flex items-center" id="addAbsensiModalLabel">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-plus text-white text-sm"></i>
                    </div>
                    Tambah Absensi - {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                </h5>
                <button type="button" class="close text-gray-400 hover:text-gray-600 text-2xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('petugas.absensi.store', $tanggal) }}" method="POST">
                @csrf
                <div class="modal-body p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="sesi_absensi_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Sesi Absensi <span class="text-red-500">*</span>
                            </label>
                            <select name="sesi_absensi_id" id="sesi_absensi_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    required>
                                <option value="">Pilih Sesi</option>
                                @foreach($sesiList as $sesi)
                                    <option value="{{ $sesi->id }}">
                                        {{ $sesi->nama }} ({{ $sesi->waktu_mulai }} - {{ $sesi->waktu_selesai }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="nama_petugas" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Petugas <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_petugas" id="nama_petugas"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status Kehadiran <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                required>
                            <option value="">Pilih Status</option>
                            @foreach($statusOptions as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="daftar_hadir_group" class="hidden">
                        <label for="daftar_hadir_text" class="block text-sm font-semibold text-gray-700 mb-2">
                            Daftar Hadir (Opsional)
                        </label>
                        <textarea name="daftar_hadir_text" id="daftar_hadir_text"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                  rows="3"
                                  placeholder="Masukkan nama-nama yang hadir, pisahkan dengan koma atau enter"></textarea>
                        <p class="text-sm text-gray-500 mt-2">Contoh: Ahmad, Budi, Citra atau satu nama per baris</p>
                    </div>
                </div>
                <div class="modal-footer border-t border-gray-200 p-6 flex flex-col sm:flex-row gap-3 sm:justify-end">
                    <button type="button"
                            class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200"
                            data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize popover
    $('[data-toggle="popover"]').popover();

    // Show/hide daftar hadir based on status
    $('#status').change(function() {
        if ($(this).val() === 'hadir') {
            $('#daftar_hadir_group').removeClass('hidden');
        } else {
            $('#daftar_hadir_group').addClass('hidden');
        }
    });

    // Process daftar hadir text to array before submit
    $('form').submit(function() {
        var daftarHadirText = $('#daftar_hadir_text').val();
        if (daftarHadirText) {
            // Split by comma or newline and clean up
            var daftarHadir = daftarHadirText.split(/[,\n]/)
                .map(function(name) { return name.trim(); })
                .filter(function(name) { return name.length > 0; });

            // Add hidden inputs for each name
            daftarHadir.forEach(function(name, index) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'daftar_hadir[' + index + ']',
                    value: name
                }).appendTo(this);
            });
        }
    });

    // Auto dismiss alerts
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);

    // Add smooth scroll behavior
    $('html').css('scroll-behavior', 'smooth');
});
</script>
@endpush