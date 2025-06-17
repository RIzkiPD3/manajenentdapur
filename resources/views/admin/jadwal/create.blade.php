@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-600 rounded-lg mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Jadwal Piket</h1>
            <p class="text-gray-600 mt-1">Buat jadwal piket baru untuk kelompok yang dipilih</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Jadwal Piket</h2>
            </div>

            <form action="{{ route('admin.jadwal.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Hari Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Hari</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @php
                            $hari_options = [
                                'senin' => 'Senin',
                                'selasa' => 'Selasa',
                                'rabu' => 'Rabu',
                                'kamis' => 'Kamis',
                                'jumat' => 'Jumat',
                                'sabtu' => 'Sabtu',
                                'minggu' => 'Minggu'
                            ];
                        @endphp

                        @foreach($hari_options as $value => $label)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="hari" value="{{ $value }}" required class="sr-only peer">
                            <div class="flex items-center justify-center p-3 rounded-lg border-2 border-gray-200 text-gray-700 peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white hover:border-gray-300 transition-colors">
                                <span class="font-medium text-sm">{{ $label }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('hari')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelompok Piket Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelompok Piket</label>
                    <select name="kelompok_piket_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                        <option value="">-- Pilih Kelompok Piket --</option>
                        @foreach ($kelompok as $item)
                            <option value="{{ $item->id }}" {{ old('kelompok_piket_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kelompok }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelompok_piket_id')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.jadwal.index') }}"
                       class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-blue-800">Informasi</h3>
                    <p class="text-sm text-blue-700 mt-1">Pastikan untuk memilih hari dan kelompok piket yang sesuai. Jadwal yang sudah dibuat dapat diubah kembali jika diperlukan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection