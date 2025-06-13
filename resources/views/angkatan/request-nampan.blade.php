@extends('layouts.angkatan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Request Nampan</h1>
            <p class="text-lg text-gray-600">Ajukan permintaan nampan sesuai kebutuhan angkatan</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-2xl p-6 mb-8 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                <h3 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Form Pengajuan Request Nampan
                </h3>
                @if($kelompok)
                    <p class="text-blue-100 text-sm mt-2">Kelompok Piket: {{ $kelompok }}</p>
                @endif
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                <form action="{{ route('angkatan.request-nampan.store') }}" method="POST">
                    @csrf

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-blue-900 font-semibold mb-2">Ketentuan Request Nampan</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• Maksimal request 50 nampan per permintaan</li>
                                    <li>• Isi keterangan dengan jelas untuk kebutuhan apa</li>
                                    <li>• Request akan diproses oleh petugas piket</li>
                                    <li>• Status akan diupdate setelah diverifikasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Nampan -->
                    <div class="mb-8">
                        <label for="jumlah_nampan" class="block text-sm font-semibold text-gray-700 mb-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Jumlah Nampan yang Dibutuhkan
                            </div>
                        </label>
                        <div class="relative">
                            <input type="number"
                                   id="jumlah_nampan"
                                   name="jumlah_nampan"
                                   min="1"
                                   max="50"
                                   value="{{ old('jumlah_nampan') }}"
                                   class="block w-full px-4 py-4 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_nampan') border-red-500 @enderror"
                                   placeholder="Masukkan jumlah nampan (1-50)"
                                   required>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">unit</span>
                            </div>
                        </div>
                        @error('jumlah_nampan')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-8">
                        <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Keterangan Penggunaan
                                <span class="text-gray-400 ml-2">(Opsional)</span>
                            </div>
                        </label>
                        <textarea id="keterangan"
                                  name="keterangan"
                                  rows="5"
                                  maxlength="1000"
                                  class="block w-full px-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('keterangan') border-red-500 @enderror"
                                  placeholder="Jelaskan untuk kebutuhan apa nampan ini diperlukan...">{{ old('keterangan') }}</textarea>
                        <div class="flex justify-between items-center mt-2">
                            @error('keterangan')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @else
                                <div></div>
                            @enderror
                            <span class="text-xs text-gray-500" id="charCount">0/1000 karakter</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('angkatan.dashboard') }}"
                           class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl font-medium hover:from-blue-600 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="mt-8 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100">
            <h4 class="text-indigo-900 font-semibold mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                Tips Pengajuan Request
            </h4>
            <div class="grid md:grid-cols-2 gap-4 text-sm text-indigo-800">
                <div class="flex items-start">
                    <span class="flex-shrink-0 w-2 h-2 bg-indigo-400 rounded-full mt-2 mr-3"></span>
                    <span>Pastikan jumlah nampan sesuai kebutuhan nyata</span>
                </div>
                <div class="flex items-start">
                    <span class="flex-shrink-0 w-2 h-2 bg-indigo-400 rounded-full mt-2 mr-3"></span>
                    <span>Isi keterangan dengan detail dan jelas</span>
                </div>
                <div class="flex items-start">
                    <span class="flex-shrink-0 w-2 h-2 bg-indigo-400 rounded-full mt-2 mr-3"></span>
                    <span>Cek riwayat untuk melihat status request</span>
                </div>
                <div class="flex items-start">
                    <span class="flex-shrink-0 w-2 h-2 bg-indigo-400 rounded-full mt-2 mr-3"></span>
                    <span>Hubungi petugas jika ada pertanyaan</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Character counter for keterangan
    const keteranganTextarea = document.getElementById('keterangan');
    const charCount = document.getElementById('charCount');

    if (keteranganTextarea && charCount) {
        keteranganTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCount.textContent = `${currentLength}/1000 karakter`;

            if (currentLength > 900) {
                charCount.classList.add('text-orange-500');
            } else if (currentLength > 950) {
                charCount.classList.remove('text-orange-500');
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-orange-500', 'text-red-500');
                charCount.classList.add('text-gray-500');
            }
        });

        // Initial count
        const initialLength = keteranganTextarea.value.length;
        charCount.textContent = `${initialLength}/1000 karakter`;
    }

    // Number input validation
    const jumlahInput = document.getElementById('jumlah_nampan');
    if (jumlahInput) {
        jumlahInput.addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value > 50) {
                this.value = 50;
            } else if (value < 1) {
                this.value = 1;
            }
        });
    }
</script>
@endpush
@endsection