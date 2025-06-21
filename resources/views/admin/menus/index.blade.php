@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-1">
                    Daftar Menu
                </h1>
                <p class="text-gray-600">
                    Total: <span class="font-medium text-blue-600">{{ $menus->total() }}</span> menu
                </p>
            </div>
            <a href="{{ route('admin.menus.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Menu
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.parentElement.remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
                <button type="button" class="ml-auto text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Menu Table -->
    @if($menus->isNotEmpty())
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Menu</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Sesi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Dibuat</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($menus as $menu)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-2 h-8 bg-blue-500 rounded-full mr-3"></div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $menu->nama_menu }}</p>
                                            <p class="text-sm text-gray-500">ID: #{{ $menu->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    {{ \Carbon\Carbon::parse($menu->tanggal)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $sesiConfig = [
                                            'pagi' => ['color' => 'yellow', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                                            'siang' => ['color' => 'orange', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                                            'malam' => ['color' => 'purple', 'icon' => 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z']
                                        ];
                                        $config = $sesiConfig[$menu->sesi] ?? $sesiConfig['pagi'];
                                    @endphp
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-{{ $config['color'] }}-100 rounded-lg flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-{{ $config['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-900 font-medium capitalize">{{ $menu->sesi }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($menu->created_at)->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.menus.show', $menu->id) }}"
                                           class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                           title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                           class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors"
                                           title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.menus.destroy', $menu->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $menu->nama_menu }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 bg-white rounded-lg shadow-sm border p-4">
            {{ $menus->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada menu</h3>
            <p class="text-gray-500 mb-6">Mulai dengan menambahkan menu pertama</p>
            <a href="{{ route('admin.menus.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Menu Pertama
            </a>
        </div>
    @endif
</div>
@endsection