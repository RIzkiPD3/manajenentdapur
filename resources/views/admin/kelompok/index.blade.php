@extends('layouts.admin')

@section('title', 'Kelompok Piket - Admin')
@section('page-title', 'Kelompok Piket')
@section('page-description', 'Kelola kelompok piket dapur')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 mb-2 flex items-center">
                    <i class="fa-solid fa-users text-blue-400 mr-3"></i>
                    Kelompok Piket
                </h1>
                <p class="text-slate-600">
                    Total: <span class="font-semibold text-blue-400">{{ $kelompokList->count() }}</span> kelompok
                </p>
            </div>
            <a href="{{ route('admin.kelompok.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                <i class="fa-solid fa-plus text-sm"></i>
                <span>Tambah Kelompok</span>
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-6 px-6 py-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-exclamation-circle text-red-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
                <button type="button" class="ml-auto text-red-500 hover:text-red-700 transition-colors" onclick="this.parentElement.parentElement.remove()">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Daftar Kelompok -->
    @if($kelompokList->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kelompokList as $index => $kelompok)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                        <div class="text-center">
                            <h3 class="text-white font-bold text-lg">{{ $kelompok->nama_kelompok }}</h3>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        @if(is_array($kelompok->anggota))
                            <div class="mb-4">
                                <h4 class="text-sm font-semibold text-slate-600 mb-3 flex items-center">
                                    <i class="fa-solid fa-list-ul text-slate-400 mr-2"></i>
                                    Anggota Kelompok
                                </h4>
                                <div class="space-y-2">
                                    @foreach($kelompok->anggota as $anggota)
                                        <div class="flex items-center space-x-3 p-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fa-solid fa-user text-blue-600 text-sm"></i>
                                            </div>
                                            <span class="text-slate-700 font-medium">{{ $anggota }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <i class="fa-solid fa-exclamation-triangle text-4xl text-slate-300 mb-3"></i>
                                <p class="text-slate-500">Data anggota tidak valid</p>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex space-x-2 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.kelompok.edit', $kelompok->id) }}"
                               class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 text-center flex items-center justify-center">
                                <i class="fa-solid fa-edit text-sm mr-2"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.kelompok.destroy', $kelompok->id) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelompok {{ $kelompok->nama_kelompok }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center">
                                    <i class="fa-solid fa-trash text-sm mr-2"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-users text-3xl text-slate-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-slate-700 mb-2">Belum ada kelompok piket</h3>
            <p class="text-slate-500 mb-6">Mulai dengan menambahkan kelompok piket pertama</p>
            <a href="{{ route('admin.kelompok.create') }}"
               class="inline-flex items-center justify-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fa-solid fa-plus mr-2"></i>
                <span>Tambah Kelompok Pertama</span>
            </a>
        </div>
    @endif
</div>
@endsection