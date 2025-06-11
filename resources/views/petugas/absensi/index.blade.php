@extends('layouts.petugas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4">
    <div class="max-w-md mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 mb-6 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Absensi Piket</h2>
                <p class="text-indigo-100">Catat kehadiran Anda hari ini</p>
            </div>
        </div>

        @if(isset($sesi))
            <!-- Session Info Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-6 p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $sesi->nama_sesi }}</h3>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $sesi->waktu_mulai }} - {{ $sesi->waktu_selesai }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Form -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <form action="{{ route('petugas.absensi.store', $sesi->id) }}" method="POST" class="p-6">
                    @csrf

                    <div class="mb-8">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-3">
                            Status Kehadiran
                        </label>

                        <div class="space-y-3">
                            <label class="relative flex items-center p-4 cursor-pointer rounded-xl border-2 border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-200 group">
                                <input type="radio" name="status" value="hadir" required class="sr-only peer">
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center peer-checked:border-green-500 peer-checked:bg-green-500 transition-all duration-200">
                                    <div class="w-2 h-2 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200"></div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">Hadir</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">Saya hadir dalam sesi piket ini</p>
                                </div>
                                <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-green-500 peer-checked:bg-green-50 pointer-events-none"></div>
                            </label>

                            <label class="relative flex items-center p-4 cursor-pointer rounded-xl border-2 border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all duration-200 group">
                                <input type="radio" name="status" value="tidak hadir" required class="sr-only peer">
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center peer-checked:border-red-500 peer-checked:bg-red-500 transition-all duration-200">
                                    <div class="w-2 h-2 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200"></div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">Tidak Hadir</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">Saya tidak dapat hadir dalam sesi piket ini</p>
                                </div>
                                <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-red-500 peer-checked:bg-red-50 pointer-events-none"></div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <span>Kirim Absensi</span>
                    </button>
                </form>
            </div>
        @else
            <!-- No Session Available -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Sesi</h3>
                <p class="text-gray-600 mb-6">Tidak ada sesi yang tersedia untuk hari ini.</p>
                <a href="{{ route('petugas.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.peer:checked ~ div .w-2 {
    opacity: 1;
}
</style>
@endsection