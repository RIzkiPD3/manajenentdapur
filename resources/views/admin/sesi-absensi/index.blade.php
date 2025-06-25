@extends('layouts.admin')

@section('page-title', 'Sesi Absensi')
@section('page-description', 'Kelola sesi absensi Santri')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Actions -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Manajemen Sesi Absensi</h1>
            <p class="text-slate-600 text-sm mt-1">Kelola jadwal sesi absensi harian</p>
        </div>
        <a href="{{ route('admin.sesi-absensi.create') }}"
           class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Sesi
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        @if($sesi->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Sesi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Waktu Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Waktu Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sesi as $index => $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-slate-800">{{ $index + 1 }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $badgeColors = [
                                            'Pagi' => 'bg-orange-100 text-orange-800',
                                            'Siang' => 'bg-blue-100 text-blue-800',
                                            'Malam' => 'bg-purple-100 text-purple-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $badgeColors[$item->nama_sesi] ?? 'bg-slate-100 text-slate-800' }}">
                                        <i class="fa-solid fa-clock mr-1"></i>
                                        {{ $item->nama_sesi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-slate-800 font-medium">{{ date('H:i', strtotime($item->waktu_mulai)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-slate-800 font-medium">{{ date('H:i', strtotime($item->waktu_selesai)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.sesi-absensi.edit', $item->id) }}"
                                           class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                                            <i class="fa-solid fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.sesi-absensi.destroy', $item->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus sesi {{ $item->nama_sesi }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                                                <i class="fa-solid fa-trash mr-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-clipboard-check text-2xl text-slate-400"></i>
                </div>
                <h3 class="text-lg font-medium text-slate-800 mb-2">Belum ada sesi absensi</h3>
                <p class="text-slate-600 mb-6">Mulai dengan membuat sesi absensi pertama untuk sistem</p>
                <a href="{{ route('admin.sesi-absensi.create') }}"
                   class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Tambah Sesi
                </a>
            </div>
        @endif
    </div>
</div>
@endsection