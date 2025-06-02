@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Manajemen Sesi Absensi</h1>

    <div class="bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-xl font-semibold">Daftar Sesi Absensi</h2>
            <a href="{{ route('sesi-absensi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Tambah Sesi Baru
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
                    <th class="px-4 py-2 text-left">Nama Sesi</th>
                    <th class="px-4 py-2 text-left">Tanggal Mulai</th>
                    <th class="px-4 py-2 text-left">Tanggal Selesai</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sesiAbsensis as $sesi)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $sesi->nama }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($sesi->tanggal_mulai)->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($sesi->tanggal_selesai)->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            @if($sesi->status === 'aktif')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('sesi-absensi.edit', $sesi->id) }}" class="text-blue-500 hover:text-blue-700">
                                    Edit
                                </a>
                                <form action="{{ route('sesi-absensi.destroy', $sesi->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus sesi absensi ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                            Tidak ada sesi absensi yang tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
