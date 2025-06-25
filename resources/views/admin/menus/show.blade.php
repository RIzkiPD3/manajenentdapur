@extends('layouts.admin')

@section('title', 'Detail Menu - Admin')
@section('page-title', 'Detail Menu')
@section('page-description', 'Informasi lengkap menu yang dipilih')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Menu Card -->
    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
        <!-- Menu Name -->
        <div class="mb-6">
            <div class="flex items-center mb-2">
                <div class="w-3 h-8 bg-green-500 rounded-full mr-3"></div>
                <h2 class="text-xl font-semibold text-slate-900">{{ $menu->nama_menu }}</h2>
            </div>
            <p class="text-sm text-slate-500 ml-6">ID: #{{ str_pad($menu->id, 3, '0', STR_PAD_LEFT) }}</p>
        </div>

        <!-- Menu Details -->
        <div class="space-y-4">
            <!-- Sesi -->
            <div class="flex items-center justify-between py-3 border-b border-slate-100">
                <span class="text-slate-600 font-medium">Sesi</span>
                <div class="flex items-center">
                    @php
                        $sesiConfig = [
                            'pagi' => [
                                'color' => 'orange-500',
                                'bg' => 'orange-100',
                                'icon' => 'fa-sun'
                            ],
                            'siang' => [
                                'color' => 'yellow-500',
                                'bg' => 'yellow-100',
                                'icon' => 'fa-sun'
                            ],
                            'malam' => [
                                'color' => 'purple-500',
                                'bg' => 'purple-100',
                                'icon' => 'fa-moon'
                            ]
                        ];
                        $config = $sesiConfig[$menu->sesi] ?? $sesiConfig['pagi'];
                    @endphp
                    <div class="w-8 h-8 bg-{{ $config['bg'] }} rounded-lg flex items-center justify-center mr-3">
                        <i class="fas {{ $config['icon'] }} text-{{ $config['color'] }} text-sm"></i>
                    </div>
                    <span class="text-slate-800 font-medium capitalize">{{ $menu->sesi }}</span>
                </div>
            </div>

            <!-- Tanggal -->
            <div class="flex items-center justify-between py-3 border-b border-slate-100">
                <span class="text-slate-600 font-medium">Tanggal</span>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-calendar-alt text-blue-500 text-sm"></i>
                    </div>
                    <span class="text-slate-800 font-medium">{{ \Carbon\Carbon::parse($menu->tanggal)->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>

            <!-- Dibuat -->
            <div class="flex items-center justify-between py-3">
                <span class="text-slate-600 font-medium">Dibuat</span>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-clock text-slate-500 text-sm"></i>
                    </div>
                    <span class="text-slate-600">{{ \Carbon\Carbon::parse($menu->created_at)->diffForHumans() }}</span>
                </div>
            </div>

            <!-- Terakhir Diupdate -->
            @if($menu->updated_at != $menu->created_at)
            <div class="flex items-center justify-between py-3 border-t border-slate-100">
                <span class="text-slate-600 font-medium">Terakhir Diupdate</span>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-edit text-cyan-500 text-sm"></i>
                    </div>
                    <span class="text-slate-600">{{ \Carbon\Carbon::parse($menu->updated_at)->diffForHumans() }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-3 mt-6">
        <a href="{{ route('admin.menus.index') }}"
           class="flex-1 bg-slate-600 hover:bg-slate-700 text-white font-medium px-4 py-3 rounded-lg transition-colors text-center flex items-center justify-center space-x-2">
            <i class="fas fa-arrow-left text-sm"></i>
            <span>Kembali</span>
        </a>
        <a href="{{ route('admin.menus.edit', $menu->id) }}"
           class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-3 rounded-lg transition-colors text-center flex items-center justify-center space-x-2">
            <i class="fas fa-edit text-sm"></i>
            <span>Edit Menu</span>
        </a>
    </div>

    <!-- Additional Info Card -->
    <div class="bg-slate-50 rounded-lg border border-slate-200 p-4 mt-6">
        <div class="flex items-center space-x-2 text-slate-600 text-sm">
            <i class="fas fa-info-circle text-slate-400"></i>
            <span>Menu ini dapat diedit atau dihapus melalui halaman daftar menu</span>
        </div>
    </div>
</div>
@endsection