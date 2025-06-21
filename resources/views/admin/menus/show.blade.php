@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Detail Menu</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap menu yang dipilih</p>
        </div>

        <!-- Menu Card -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <!-- Menu Name -->
            <div class="mb-6">
                <div class="flex items-center mb-2">
                    <div class="w-3 h-8 bg-blue-500 rounded-full mr-3"></div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $menu->nama_menu }}</h2>
                </div>
                <p class="text-sm text-gray-500 ml-6">ID: #{{ $menu->id }}</p>
            </div>

            <!-- Menu Details -->
            <div class="space-y-4">
                <!-- Sesi -->
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Sesi</span>
                    <div class="flex items-center">
                        @php
                            $sesiConfig = [
                                'pagi' => ['color' => 'yellow', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                                'siang' => ['color' => 'orange', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                                'malam' => ['color' => 'purple', 'icon' => 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z']
                            ];
                            $config = $sesiConfig[$menu->sesi] ?? $sesiConfig['pagi'];
                        @endphp
                        <div class="w-8 h-8 bg-{{ $config['color'] }}-100 rounded-lg flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-{{ $config['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium capitalize">{{ $menu->sesi }}</span>
                    </div>
                </div>

                <!-- Tanggal -->
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Tanggal</span>
                    <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($menu->tanggal)->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Dibuat -->
                <div class="flex items-center justify-between py-3">
                    <span class="text-gray-600 font-medium">Dibuat</span>
                    <span class="text-gray-500">{{ \Carbon\Carbon::parse($menu->created_at)->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 mt-6">
            <a href="{{ route('admin.menus.index') }}"
               class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-lg transition-colors text-center">
                Kembali
            </a>
            <a href="{{ route('admin.menus.edit', $menu->id) }}"
               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors text-center">
                Edit Menu
            </a>
        </div>
    </div>
</div>
@endsection