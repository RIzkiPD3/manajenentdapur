@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tambah Menu Baru</h2>

        <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
                <input type="text"
                       name="nama_menu"
                       value="{{ old('nama_menu') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       placeholder="Masukkan nama menu"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Resep</label>
                <textarea name="resep"
                          rows="8"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                          placeholder="Masukkan langkah-langkah memasak"
                          required>{{ old('resep') }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Jelaskan cara memasak secara detail</p>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('admin.menus.index') }}"
                   class="flex-1 px-6 py-3 bg-gray-500 text-white text-center rounded-lg hover:bg-gray-600 transition-colors font-medium">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Tambahkan Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection