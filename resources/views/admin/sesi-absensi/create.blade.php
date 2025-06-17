@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Tambah Sesi Absensi</h1>
            <p class="text-gray-600 mt-1">Buat sesi absensi baru untuk mengatur waktu kehadiran</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100">
            <!-- Card Body -->
            <div class="p-8">
                <form action="{{ route('admin.sesi-absensi.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama Sesi -->
                    <div>
                        <label for="nama_sesi" class="block text-sm font-semibold text-gray-800 mb-3">
                            Nama Sesi <span class="text-red-500">*</span>
                        </label>
                        <select name="nama_sesi" id="nama_sesi" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors duration-200 hover:border-gray-400">
                            <option value="">-- Pilih Sesi --</option>
                            <option value="Pagi" {{ old('nama_sesi') === 'Pagi' ? 'selected' : '' }}>Pagi</option>
                            <option value="Siang" {{ old('nama_sesi') === 'Siang' ? 'selected' : '' }}>Siang</option>
                            <option value="Malam" {{ old('nama_sesi') === 'Malam' ? 'selected' : '' }}>Malam</option>
                        </select>
                        @error('nama_sesi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Time Inputs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Waktu Mulai -->
                        <div>
                            <label for="waktu_mulai" class="block text-sm font-semibold text-gray-800 mb-3">
                                Waktu Mulai <span class="text-red-500">*</span>
                            </label>
                            <input type="time"
                                   name="waktu_mulai"
                                   id="waktu_mulai"
                                   value="{{ old('waktu_mulai') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 hover:border-gray-400">
                            @error('waktu_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Selesai -->
                        <div>
                            <label for="waktu_selesai" class="block text-sm font-semibold text-gray-800 mb-3">
                                Waktu Selesai <span class="text-red-500">*</span>
                            </label>
                            <input type="time"
                                   name="waktu_selesai"
                                   id="waktu_selesai"
                                   value="{{ old('waktu_selesai') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors duration-200 hover:border-gray-400">
                            @error('waktu_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Info Alert -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-sm font-semibold text-blue-800">Catatan</h3>
                                <p class="text-sm text-blue-700 mt-1">Pastikan waktu selesai lebih besar dari waktu mulai.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.sesi-absensi.index') }}"
                           class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 text-center font-medium transition-colors duration-200">
                            Kembali
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 font-medium transition-colors duration-200">
                            Simpan Sesi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const waktuMulai = document.getElementById('waktu_mulai');
    const waktuSelesai = document.getElementById('waktu_selesai');

    function validateTime() {
        if (waktuMulai.value && waktuSelesai.value) {
            if (waktuMulai.value >= waktuSelesai.value) {
                waktuSelesai.setCustomValidity('Waktu selesai harus lebih besar dari waktu mulai');
                waktuSelesai.classList.add('border-red-500');
                waktuSelesai.classList.remove('border-gray-300');
            } else {
                waktuSelesai.setCustomValidity('');
                waktuSelesai.classList.remove('border-red-500');
                waktuSelesai.classList.add('border-gray-300');
            }
        }
    }

    waktuMulai.addEventListener('change', function() {
        waktuSelesai.min = this.value;
        validateTime();
    });

    waktuSelesai.addEventListener('change', validateTime);
});
</script>
@endsection