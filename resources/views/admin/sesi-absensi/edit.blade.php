@extends('layouts.admin')

@section('title', 'Edit Sesi Absensi - Admin')

@section('page-title', 'Edit Sesi Absensi')
@section('page-description', 'Ubah informasi sesi absensi dengan benar')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <form action="{{ route('admin.sesi-absensi.update', $sesi) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Sesi -->
                <div>
                    <label for="nama_sesi" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Sesi <span class="text-red-500">*</span>
                    </label>
                    <select name="nama_sesi" id="nama_sesi" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 bg-white transition-colors">
                        <option value="Pagi" {{ $sesi->nama_sesi === 'Pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="Siang" {{ $sesi->nama_sesi === 'Siang' ? 'selected' : '' }}>Siang</option>
                        <option value="Malam" {{ $sesi->nama_sesi === 'Malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                    @error('nama_sesi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Time Inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Waktu Mulai -->
                    <div>
                        <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                            Waktu Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="time"
                               name="waktu_mulai"
                               id="waktu_mulai"
                               value="{{ $sesi->waktu_mulai }}"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors">
                        @error('waktu_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu Selesai -->
                    <div>
                        <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                            Waktu Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="time"
                               name="waktu_selesai"
                               id="waktu_selesai"
                               value="{{ $sesi->waktu_selesai }}"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors">
                        @error('waktu_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Info Alert -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <i class="fa-solid fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                        <div>
                            <h3 class="text-sm font-medium text-blue-800">Catatan</h3>
                            <p class="text-sm text-blue-700 mt-1">Pastikan waktu selesai lebih besar dari waktu mulai.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.sesi-absensi.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 text-center font-medium transition-colors">
                        Kembali
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 focus:ring-2 focus:ring-cyan-500 font-medium transition-colors">
                        <i class="fa-solid fa-save mr-1"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
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
@endpush
@endsection