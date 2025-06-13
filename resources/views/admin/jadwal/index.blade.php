@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                        Manajemen Jadwal Piket
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola jadwal piket dengan mudah dan efisien</p>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <div class="bg-white/70 backdrop-blur-sm rounded-full px-6 py-3 shadow-sm border border-white/20">
                        <span class="text-sm text-gray-600">Total Jadwal: </span>
                        <span class="font-semibold text-blue-600">{{ $jadwals->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 transform transition-all duration-500 ease-in-out animate-pulse">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-4 rounded-xl shadow-lg border-l-4 border-emerald-300">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-2xl rounded-2xl border border-white/20 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Daftar Jadwal Piket</h2>
                    </div>
                    <a href="{{ route('admin.jadwal.create') }}"
                       class="group bg-white/20 hover:bg-white/30 text-white font-semibold px-6 py-3 rounded-xl
                              transition-all duration-300 transform hover:scale-105 hover:shadow-lg
                              border border-white/30 backdrop-blur-sm">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Tambah Jadwal Baru</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>No</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>Kelompok</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Hari</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center justify-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                    <span>Aksi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($jadwals as $item)
                            <tr class="group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-sm font-semibold">{{ $loop->iteration }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $item->kelompok->nama_kelompok ?? 'Nama Kelompok Tidak Ada' }}</div>
                                            <div class="text-sm text-gray-500">Tim Piket</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="bg-gradient-to-r from-purple-100 to-pink-100 px-3 py-2 rounded-lg inline-block">
                                        <div class="font-semibold text-purple-800">{{ $item->hari }}</div>
                                        <div class="text-xs text-purple-600">Hari Piket</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('admin.jadwal.edit', $item->id) }}"
                                           class="group flex items-center space-x-1 bg-gradient-to-r from-blue-500 to-indigo-500
                                                  hover:from-blue-600 hover:to-indigo-600 text-white px-4 py-2 rounded-lg
                                                  transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                            <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span class="text-sm font-medium">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="group flex items-center space-x-1 bg-gradient-to-r from-red-500 to-pink-500
                                                           hover:from-red-600 hover:to-pink-600 text-white px-4 py-2 rounded-lg
                                                           transition-all duration-300 transform hover:scale-105 hover:shadow-lg"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span class="text-sm font-medium">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-4">
                                        <div class="w-20 h-20 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada jadwal piket</h3>
                                            <p class="text-gray-500 mb-4">Mulai dengan menambahkan jadwal piket pertama Anda</p>
                                            <a href="{{ route('admin.jadwal.create') }}"
                                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500
                                                      text-white font-medium rounded-lg hover:from-blue-600 hover:to-indigo-600
                                                      transition-all duration-300 transform hover:scale-105">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Tambah Jadwal Pertama
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Stats -->
        @if($jadwals->count() > 0)
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Jadwal</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $jadwals->count() }}</p>
                        </div>
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Kelompok Aktif</p>
                            <p class="text-3xl font-bold text-emerald-600">{{ $jadwals->pluck('kelompok.nama_kelompok')->unique()->count() }}</p>
                        </div>
                        <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Hari Berbeda</p>
                            <p class="text-3xl font-bold text-purple-600">{{ $jadwals->pluck('hari')->unique()->count() }}</p>
                        </div>
                        <div class="p-3 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out;
    }

    tbody tr {
        animation: fadeInUp 0.4s ease-out;
        animation-fill-mode: both;
    }

    tbody tr:nth-child(1) { animation-delay: 0.1s; }
    tbody tr:nth-child(2) { animation-delay: 0.2s; }
    tbody tr:nth-child(3) { animation-delay: 0.3s; }
    tbody tr:nth-child(4) { animation-delay: 0.4s; }
    tbody tr:nth-child(5) { animation-delay: 0.5s; }
</style>
@endpush
@endsection