@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0l3-3m-3 3l3 3m6-9a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Sesi Absensi</h1>
            <p class="text-gray-600">Ubah informasi sesi absensi dengan benar</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 bg-gradient-to-r from-indigo-600 to-blue-500">
                <h2 class="text-xl font-semibold text-white">Form Edit Sesi</h2>
            </div>

            <!-- FIXED: Menggunakan parameter 'sesi' alih-alih 'sesi_absensi' -->
            <form action="{{ route('admin.sesi-absensi.update', $sesi) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Sesi -->
                <div>
                    <label for="nama_sesi" class="block text-sm font-semibold text-gray-700 mb-2">Nama Sesi</label>
                    <select name="nama_sesi" id="nama_sesi" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-300 bg-gray-50 hover:bg-white">
                        <option value="Pagi" {{ $sesi->nama_sesi === 'Pagi' ? 'selected' : '' }}>🌅 Pagi</option>
                        <option value="Siang" {{ $sesi->nama_sesi === 'Siang' ? 'selected' : '' }}>☀️ Siang</option>
                        <option value="Malam" {{ $sesi->nama_sesi === 'Malam' ? 'selected' : '' }}>🌙 Malam</option>
                    </select>
                    @error('nama_sesi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu Mulai -->
                <div>
                    <label for="waktu_mulai" class="block text-sm font-semibold text-gray-700 mb-2">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" value="{{ $sesi->waktu_mulai }}" required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-300 bg-gray-50 hover:bg-white text-gray-700">
                    @error('waktu_mulai')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu Selesai -->
                <div>
                    <label for="waktu_selesai" class="block text-sm font-semibold text-gray-700 mb-2">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" value="{{ $sesi->waktu_selesai }}" required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-300 bg-gray-50 hover:bg-white text-gray-700">
                    @error('waktu_selesai')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.sesi-absensi.index') }}"
                       class="flex-1 inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 bg-white rounded-xl hover:bg-gray-50 focus:ring-2 focus:ring-gray-200 transition font-semibold">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-700 text-white rounded-xl hover:from-indigo-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-200 font-semibold transition-all shadow-md">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection