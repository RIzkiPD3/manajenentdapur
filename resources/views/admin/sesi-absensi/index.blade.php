@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Sesi Absensi</h1>
        <a href="{{ route('sesi-absensi.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Sesi
        </a>
    </div>

    <table class="w-full border text-left text-sm">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="p-2">Tanggal</th>
                <th class="p-2">Sesi</th>
                <th class="p-2">Waktu Mulai</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sesi as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->tanggal }}</td>
                <td class="p-2">{{ $item->nama_sesi }}</td>
                <td class="p-2">{{ $item->waktu_mulai }}</td>
                <td class="p-2 flex space-x-2">
                    <a href="{{ route('sesi-absensi.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('sesi-absensi.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus sesi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
