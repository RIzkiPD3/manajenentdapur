@extends('layouts.angkatan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    Dashboard Angkatan
                </h1>
                <p class="text-gray-600">
                    Selamat datang kembali, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8">
        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <!-- Request Nampan Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Permintaan Nampan</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm">
                        Ajukan permintaan nampan tambahan untuk kebutuhan makan di asrama
                    </p>
                    <a href="{{ route('angkatan.request-nampan.create') }}"
                       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                        Buat Permintaan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- History Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Riwayat Permintaan</h3>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm">
                        Lihat status dan riwayat semua permintaan nampan yang telah diajukan
                    </p>
                    <a href="{{ route('angkatan.riwayat-request') }}"
                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                        Lihat Riwayat
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection