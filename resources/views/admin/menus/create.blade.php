@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 to-red-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah Menu Baru</h1>
            <p class="text-gray-600">Buat menu lezat untuk pelanggan Anda</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2"></div>

            <form action="{{ route('admin.menus.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Nama Menu Field -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-orange-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Nama Menu
                        </div>
                    </label>
                    <input
                        type="text"
                        name="nama_menu"
                        required
                        placeholder="Masukkan nama menu yang menarik..."
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 outline-none hover:border-gray-300"
                    >
                </div>

                <!-- Resep Field -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-orange-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Resep & Instruksi
                        </div>
                    </label>
                    <textarea
                        name="resep"
                        rows="6"
                        required
                        placeholder="Tulis resep lengkap dengan bahan-bahan dan langkah-langkah pembuatan..."
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 outline-none hover:border-gray-300 resize-none"
                    ></textarea>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-gray-500">Berikan detail yang jelas untuk hasil terbaik</p>
                        <div class="text-xs text-gray-400">Min. 50 karakter</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-100">
                    <a
                        href="{{ route('admin.menus.index') }}"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-lg transition-all duration-200 text-center border border-gray-200 hover:border-gray-300"
                    >
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </div>
                    </a>
                    <button
                        type="submit"
                        class="flex-1 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    >
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Menu
                        </div>
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="font-medium text-blue-800 mb-1">Tips Membuat Menu yang Menarik</h3>
                    <p class="text-sm text-blue-700">Pastikan nama menu mudah diingat dan resep dijelaskan dengan detail untuk konsistensi kualitas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection