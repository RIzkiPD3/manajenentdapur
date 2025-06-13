@extends('layouts.admin')

@section('content')
<!-- Hero Section -->
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50">
    <!-- Header with animated background -->
    <div class="relative overflow-hidden bg-white shadow-sm border-b border-gray-200">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-2">
                    Dashboard Admin
                </h1>
                <p class="text-lg text-gray-600">Selamat datang kembali, Admin</p>
                <div class="mt-2 h-1 w-24 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mx-auto"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Card 1 - Total Angkatan -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 group hover:border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Angkatan</p>
                        <p class="text-2xl font-bold text-gray-900">12</p>
                        <p class="text-xs text-blue-600 mt-1">Angkatan aktif</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 2 - Total Kelompok -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 group hover:border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Kelompok</p>
                        <p class="text-2xl font-bold text-gray-900">48</p>
                        <p class="text-xs text-green-600 mt-1">Kelompok terdaftar</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3 - Kelompok yang Bertugas -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 group hover:border-purple-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Kelompok Bertugas</p>
                        <p class="text-2xl font-bold text-gray-900">6</p>
                        <p class="text-xs text-purple-600 mt-1">Sedang bertugas hari ini</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 4 - Menu Hari Ini -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 group hover:border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Menu Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">3</p>
                        <p class="text-xs text-orange-600 mt-1">Menu tersedia</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Quick Actions
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <button class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 group border border-blue-100 hover:border-blue-200">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Kelola Angkatan</span>
                </button>

                <button class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg hover:from-green-100 hover:to-emerald-100 transition-all duration-300 group border border-green-100 hover:border-green-200">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Kelola Kelompok</span>
                </button>

                <button class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-violet-50 rounded-lg hover:from-purple-100 hover:to-violet-100 transition-all duration-300 group border border-purple-100 hover:border-purple-200">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Jadwal Tugas</span>
                </button>

                <button class="flex items-center p-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-lg hover:from-orange-100 hover:to-red-100 transition-all duration-300 group border border-orange-100 hover:border-orange-200">
                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Kelola Menu</span>
                </button>
            </div>
        </div>

        <!-- Enhanced Information Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Kelompok Bertugas Hari Ini -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Kelompok Bertugas Hari Ini
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg border border-purple-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Kelompok A - Angkatan 2023</span>
                        </div>
                        <span class="text-xs text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Sarapan</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Kelompok B - Angkatan 2022</span>
                        </div>
                        <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Makan Siang</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Kelompok C - Angkatan 2024</span>
                        </div>
                        <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">Makan Malam</span>
                    </div>
                </div>
            </div>

            <!-- Menu Hari Ini -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Menu Hari Ini
                </h3>
                <div class="space-y-4">
                    <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-semibold text-gray-900">Sarapan</h4>
                            <span class="text-xs text-yellow-600">07:00 - 09:00</span>
                        </div>
                        <p class="text-sm text-gray-600">Nasi Gudeg, Telur, Tempe Bacem</p>
                    </div>
                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-semibold text-gray-900">Makan Siang</h4>
                            <span class="text-xs text-blue-600">12:00 - 14:00</span>
                        </div>
                        <p class="text-sm text-gray-600">Nasi Putih, Ayam Goreng, Sayur Asem</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-semibold text-gray-900">Makan Malam</h4>
                            <span class="text-xs text-green-600">18:00 - 20:00</span>
                        </div>
                        <p class="text-sm text-gray-600">Nasi Putih, Ikan Bakar, Tahu Tempe</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Section -->
        <div class="text-center">
            <div class="inline-block bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <div class="mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Ready to Sign Out?</h3>
                    <p class="text-sm text-gray-600 mb-6">Terima kasih telah menggunakan dashboard admin</p>
                </div>

                <form action="{{ url('/logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="group relative inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                        </svg>
                        Sign Out
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 rounded-lg transition-opacity duration-200"></div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

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

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .8;
    }
}

.animate-pulse-slow {
    animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endsection