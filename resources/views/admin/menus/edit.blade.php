@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Menu</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi menu makanan</p>
            </div>
            <a href="{{ route('admin.menus.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors font-medium text-sm shadow-sm">
                ← Kembali
            </a>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 mb-6 rounded-lg">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit Menu</h2>
        </div>

        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Nama Menu -->
                <div>
                    <label for="nama_menu" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Menu <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="nama_menu"
                           name="nama_menu"
                           value="{{ old('nama_menu', $menu->nama_menu) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('nama_menu') border-red-500 @enderror"
                           required
                           placeholder="Masukkan nama menu">
                    @error('nama_menu')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Resep -->
                <div>
                    <label for="resep" class="block text-sm font-medium text-gray-700 mb-2">
                        Resep <span class="text-red-500">*</span>
                    </label>
                    <textarea id="resep"
                              name="resep"
                              rows="8"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('resep') border-red-500 @enderror"
                              required
                              placeholder="Masukkan resep lengkap dengan bahan-bahan dan cara pembuatan">{{ old('resep', $menu->resep) }}</textarea>
                    @error('resep')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">
                        Tulis resep secara detail termasuk bahan-bahan dan langkah-langkah pembuatan
                    </p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-6">
                <a href="{{ route('admin.menus.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-medium">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm">
                    Update Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection