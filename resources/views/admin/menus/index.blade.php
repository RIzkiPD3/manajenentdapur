@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Daftar Menu
            </h1>
            <p class="text-slate-600 mt-1">
                Total: <span class="font-medium text-orange-500">{{ $menus->total() }}</span> menu
            </p>
        </div>
        <a href="{{ route('admin.menus.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus text-sm"></i>
            Tambah Menu
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Menu Table -->
    @if($menus->isNotEmpty())
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Menu</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Sesi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Dibuat</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($menus as $menu)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-2 h-8 bg-orange-500 rounded-full mr-3"></div>
                                        <div>
                                            <p class="font-medium text-slate-800">{{ $menu->nama_menu }}</p>
                                            <p class="text-sm text-slate-500">ID: #{{ $menu->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ \Carbon\Carbon::parse($menu->tanggal)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $sesiConfig = [
                                            'pagi' => ['color' => 'amber', 'icon' => 'fa-sun'],
                                            'siang' => ['color' => 'orange', 'icon' => 'fa-sun'],
                                            'malam' => ['color' => 'slate', 'icon' => 'fa-moon']
                                        ];
                                        $config = $sesiConfig[$menu->sesi] ?? $sesiConfig['pagi'];
                                    @endphp
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-{{ $config['color'] }}-100 rounded-lg flex items-center justify-center mr-2">
                                            <i class="fa-solid {{ $config['icon'] }} text-{{ $config['color'] }}-600 text-sm"></i>
                                        </div>
                                        <span class="text-slate-700 font-medium capitalize">{{ $menu->sesi }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($menu->created_at)->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-1">
                                        <a href="{{ route('admin.menus.show', $menu->id) }}"
                                           class="p-2 text-slate-600 hover:bg-slate-100 hover:text-slate-800 rounded-lg transition-colors"
                                           title="Detail">
                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                           class="p-2 text-amber-600 hover:bg-amber-50 hover:text-amber-700 rounded-lg transition-colors"
                                           title="Edit">
                                            <i class="fa-solid fa-edit text-sm"></i>
                                        </a>
                                        <form action="{{ route('admin.menus.destroy', $menu->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $menu->nama_menu }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors"
                                                    title="Hapus">
                                                <i class="fa-solid fa-trash text-sm"></i>
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
        @if($menus->hasPages())
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                {{ $menus->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-utensils text-2xl text-slate-400"></i>
            </div>
            <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum ada menu</h3>
            <p class="text-slate-500 mb-6">Mulai dengan menambahkan menu pertama</p>
            <a href="{{ route('admin.menus.create') }}"
               class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors">
                <i class="fa-solid fa-plus mr-2"></i>
                Tambah Menu Pertama
            </a>
        </div>
    @endif
</div>
@endsection
