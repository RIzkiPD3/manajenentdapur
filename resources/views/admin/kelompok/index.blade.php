@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Manajemen Kelompok Piket</h1>

    <div class="bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-xl font-semibold">Daftar Kelompok Piket</h2>
            <a href="{{ route('kelompok.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Tambah Kelompok Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Kelompok</th>
                    <th class="px-4 py-2 text-left">Jumlah Anggota</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelompoks as $kelompok)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $kelompok->nama }}</td>
                        <td class="px-4 py-2">{{ $kelompok->users_count }} Anggota</td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('kelompok.edit', $kelompok->id) }}" class="text-blue-500 hover:text-blue-700">
                                    Edit
                                </a>
                                <form action="{{ route('kelompok.destroy', $kelompok->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kelompok ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                            Tidak ada kelompok piket yang tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
