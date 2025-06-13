@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Jadwal Piket</h1>
            <p class="mt-2 text-sm text-gray-600">Perbarui informasi jadwal piket</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Hari Field -->
                <div class="space-y-2">
                    <label for="hari" class="block text-sm font-medium text-gray-700">
                        Hari <span class="text-red-500">*</span>
                    </label>
                    <select name="hari" id="hari" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   transition duration-150 ease-in-out">
                        <option value="">-- Pilih Hari --</option>
                        <option value="senin" {{ old('hari', strtolower($jadwal->hari)) == 'senin' ? 'selected' : '' }}>
                            🗓️ Senin
                        </option>
                        <option value="selasa" {{ old('hari', strtolower($jadwal->hari)) == 'selasa' ? 'selected' : '' }}>
                            🗓️ Selasa
                        </option>
                        <option value="rabu" {{ old('hari', strtolower($jadwal->hari)) == 'rabu' ? 'selected' : '' }}>
                            🗓️ Rabu
                        </option>
                        <option value="kamis" {{ old('hari', strtolower($jadwal->hari)) == 'kamis' ? 'selected' : '' }}>
                            🗓️ Kamis
                        </option>
                        <option value="jumat" {{ old('hari', strtolower($jadwal->hari)) == 'jumat' ? 'selected' : '' }}>
                            🗓️ Jumat
                        </option>
                        <option value="sabtu" {{ old('hari', strtolower($jadwal->hari)) == 'sabtu' ? 'selected' : '' }}>
                            🗓️ Sabtu
                        </option>
                        <option value="minggu" {{ old('hari', strtolower($jadwal->hari)) == 'minggu' ? 'selected' : '' }}>
                            🗓️ Minggu
                        </option>
                    </select>
                    @error('hari')
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <!-- Kelompok Piket Field -->
                <div class="space-y-2">
                    <label for="kelompok_piket_id" class="block text-sm font-medium text-gray-700">
                        Kelompok Piket <span class="text-red-500">*</span>
                    </label>
                    <select name="kelompok_piket_id" id="kelompok_piket_id" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   transition duration-150 ease-in-out">
                        <option value="">-- Pilih Kelompok --</option>
                        @foreach ($kelompokPikets as $item)
                            <option value="{{ $item->id }}" {{ old('kelompok_piket_id', $jadwal->kelompok_piket_id) == $item->id ? 'selected' : '' }}>
                                👥 {{ $item->nama_kelompok }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelompok_piket_id')
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.jadwal.index') }}"
                       class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300
                              shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50
                              focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                              transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent
                                   shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                                   transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Jadwal
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Informasi</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Pastikan tidak ada jadwal duplikat untuk kelompok dan hari yang sama.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection