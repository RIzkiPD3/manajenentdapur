@extends('layouts.petugas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Jadwal Piket Hari Ini</h1>
            <p class="text-gray-600">{{ date('l, d F Y') }}</p>
        </div>

        {{-- Check if jadwal exists and is not empty --}}
        @if(isset($jadwal) && $jadwal->isNotEmpty())
            <div class="space-y-8">
                @foreach ($jadwal as $index => $item)
                    <!-- Main Card Container -->
                    <div class="relative">
                        <!-- Decorative elements -->
                        <div class="absolute -top-2 -left-2 w-full h-full bg-gradient-to-r from-blue-200 to-purple-200 rounded-2xl opacity-20"></div>

                        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                            <!-- Header with gradient -->
                            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-6 text-white">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                                                Piket #{{ $index + 1 }}
                                            </span>
                                        </div>
                                        <h2 class="text-2xl font-bold mb-1">{{ $item->kelompok->nama_kelompok ?? 'Kelompok tidak tersedia' }}</h2>
                                        <p class="text-blue-100">Menu: {{ $item->menu->nama_menu ?? 'Menu tidak tersedia' }}</p>
                                    </div>
                                    <div class="hidden md:block">
                                        <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recipe Content -->
                            @if(isset($item->menu->resep) && is_array($item->menu->resep))
                                <div class="p-6 space-y-6">
                                    <!-- Recipe Header -->
                                    <div class="flex items-center space-x-3 mb-6">
                                        <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-800">Resep & Cara Pembuatan</h3>
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-6">
                                        <!-- Ingredients Section -->
                                        <div class="space-y-4">
                                            <div class="flex items-center space-x-2 mb-4">
                                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <h4 class="text-lg font-semibold text-gray-800">Bahan-bahan</h4>
                                            </div>

                                            <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                                                @if(isset($item->menu->resep['bahan']))
                                                    <ul class="space-y-2">
                                                        @foreach (explode("\n", $item->menu->resep['bahan']) as $bahan)
                                                            @if(trim($bahan))
                                                                <li class="flex items-start space-x-3">
                                                                    <div class="w-2 h-2 bg-green-400 rounded-full mt-2 flex-shrink-0"></div>
                                                                    <span class="text-gray-700 leading-relaxed">{{ trim($bahan) }}</span>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p class="text-gray-500 italic">Bahan tidak tersedia</p>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Steps Section -->
                                        <div class="space-y-4">
                                            <div class="flex items-center space-x-2 mb-4">
                                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </div>
                                                <h4 class="text-lg font-semibold text-gray-800">Langkah Pembuatan</h4>
                                            </div>

                                            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                                                @if(isset($item->menu->resep['langkah']))
                                                    <ol class="space-y-3">
                                                        @foreach (explode("\n", $item->menu->resep['langkah']) as $stepIndex => $langkah)
                                                            @if(trim($langkah))
                                                                <li class="flex items-start space-x-3">
                                                                    <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold flex-shrink-0">
                                                                        {{ $stepIndex + 1 }}
                                                                    </div>
                                                                    <span class="text-gray-700 leading-relaxed">{{ trim($langkah) }}</span>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                @else
                                                    <p class="text-gray-500 italic">Langkah pembuatan tidak tersedia</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-sm font-medium">Selesai</span>
                                        </button>
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                            </svg>
                                            <span class="text-sm font-medium">Bagikan</span>
                                        </button>
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                            </svg>
                                            <span class="text-sm font-medium">Print</span>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="p-6">
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                        <p class="text-yellow-800">
                                            <strong>Perhatian:</strong> Resep untuk menu ini belum tersedia.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Jadwal Hari Ini</h3>
                <p class="text-gray-500 mb-6">Tidak ada jadwal piket yang dijadwalkan untuk hari ini.</p>
                <button class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Jadwal
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Optional: Add some custom CSS for additional animations -->
<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.6s ease-out forwards;
}
</style>
@endsection