@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Menu</h1>
                <p class="text-gray-600 mt-1">Informasi lengkap tentang menu ini</p>
            </div>
            <a href="{{ route('admin.menus.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors font-medium text-sm shadow-sm">
                ← Kembali
            </a>
        </div>
    </div>

    <!-- Menu Detail Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-900">{{ $menu->nama_menu }}</h2>
        </div>

        <div class="p-6">
            <div class="space-y-6">
                <!-- Resep Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Resep</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                            {{ $menu->resep }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex space-x-3">
                    <a href="{{ route('admin.menus.edit', $menu->id) }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm shadow-sm">
                        Edit Menu
                    </a>
                    <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus menu ini?')"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors font-medium text-sm shadow-sm">
                            Hapus Menu
                        </button>
                    </form>
                </div>

                <div class="text-sm text-gray-500">
                    <span>Dibuat: {{ $menu->created_at->format('d M Y, H:i') }}</span>
                    @if($menu->updated_at != $menu->created_at)
                        <span class="ml-4">Diperbarui: {{ $menu->updated_at->format('d M Y, H:i') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection