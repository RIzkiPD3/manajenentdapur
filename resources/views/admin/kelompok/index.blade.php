@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    Kelompok Piket
                </h1>
                <p class="text-gray-600">
                    Total: <span class="font-semibold text-blue-600">{{ $kelompokList->count() }}</span> kelompok
                </p>
            </div>
            <a href="{{ route('admin.kelompok.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Kelompok
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-6 px-6 py-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
                <button type="button" class="ml-auto text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Daftar Kelompok -->
    @if($kelompokList->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kelompokList as $index => $kelompok)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-blue-600 p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-white font-bold text-lg">{{ $kelompok->nama_kelompok }}</h3>
                            <div class="flex items-center space-x-1">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="text-white font-semibold">
                                    {{ is_array($kelompok->anggota) ? count($kelompok->anggota) : 0 }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        @if(is_array($kelompok->anggota))
                            <div class="mb-4">
                                <h4 class="text-sm font-semibold text-gray-600 mb-3">Anggota Kelompok</h4>
                                <div class="space-y-2">
                                    @foreach($kelompok->anggota as $anggota)
                                        <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-gray-700 font-medium">{{ $anggota }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500">Data anggota tidak valid</p>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex space-x-2 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.kelompok.edit', $kelompok->id) }}"
                               class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 text-center">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.kelompok.destroy', $kelompok->id) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelompok {{ $kelompok->nama_kelompok }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada kelompok piket</h3>
            <p class="text-gray-500 mb-6">Mulai dengan menambahkan kelompok piket pertama</p>
            <a href="{{ route('admin.kelompok.create') }}"
               class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Kelompok Pertama
            </a>
        </div>
    @endif
</div>
@endsection