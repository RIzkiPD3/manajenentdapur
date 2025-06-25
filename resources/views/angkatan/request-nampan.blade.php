@extends('layouts.angkatan')

@section('title', 'Request Nampan')
@section('page-title', 'Request Nampan')
@section('page-description', 'Ajukan permintaan nampan untuk kebutuhan angkatan')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Request Nampan
                </h1>
                <p class="text-slate-600 mt-2">
                    Ajukan permintaan nampan untuk kebutuhan angkatan Anda
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Request -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-orange-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-slate-900">Form Permintaan Nampan</h3>
            <p class="text-sm text-slate-600 mt-1">Isi form berikut untuk mengajukan permintaan nampan</p>
        </div>

        <form action="{{ route('angkatan.request-nampan.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Informasi Kelompok -->
            @if(isset($kelompokPiket) && $kelompokPiket)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <strong class="text-blue-800">Kelompok Piket Hari Ini:</strong>
                        <span class="text-blue-700 ml-2">{{ $kelompokPiket->nama_kelompok }}</span>
                    </div>
                </div>
            @endif

            <!-- Jumlah Nampan -->
            <div>
                <label for="jumlah_nampan" class="block text-sm font-medium text-slate-700 mb-2">
                    Jumlah Nampan *
                </label>
                <div class="relative">
                    <input type="number"
                           id="jumlah_nampan"
                           name="jumlah_nampan"
                           value="{{ old('jumlah_nampan') }}"
                           min="1"
                           max="50"
                           class="block w-full px-4 py-3 text-slate-900 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors @error('jumlah_nampan') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                           placeholder="Masukkan jumlah nampan yang dibutuhkan"
                           required>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-1 text-sm text-slate-500">Maksimal 50 nampan per permintaan</p>
                @error('jumlah_nampan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-slate-700 mb-2">
                    Keterangan (Opsional)
                </label>
                <textarea id="keterangan"
                          name="keterangan"
                          rows="4"
                          class="block w-full px-4 py-3 text-slate-900 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                          placeholder="Berikan keterangan tambahan jika diperlukan (contoh: untuk acara tertentu, kebutuhan khusus, dll.)">{{ old('keterangan') }}</textarea>
                <p class="mt-1 text-sm text-slate-500">Maksimal 1000 karakter</p>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Tambahan -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium mb-1">Informasi Penting:</p>
                        <ul class="list-disc list-inside space-y-1 text-blue-700">
                            <li>Permintaan akan diproses oleh petugas dapur</li>
                            <li>Pastikan jumlah nampan sesuai dengan kebutuhan sebenarnya</li>
                            <li>Nampan yang sudah digunakan harap dikembalikan dalam kondisi bersih</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center pt-6 border-t border-slate-200 gap-4">
                <a href="{{ route('angkatan.riwayat-request') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Lihat Riwayat
                </a>

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <button type="reset"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </button>

                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim Permintaan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const jumlahNampan = document.getElementById('jumlah_nampan').value;

        if (!jumlahNampan || jumlahNampan < 1 || jumlahNampan > 50) {
            e.preventDefault();
            alert('Jumlah nampan harus antara 1 sampai 50!');
            return false;
        }

        // Confirm submission
        if (!confirm('Apakah Anda yakin ingin mengirim permintaan ini?')) {
            e.preventDefault();
            return false;
        }
    });

    // Auto-resize textarea
    const textarea = document.getElementById('keterangan');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>
@endpush
@endsection