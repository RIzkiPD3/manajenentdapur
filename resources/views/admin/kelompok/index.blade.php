@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Kelompok Piket</h1>
        <a href="{{ route('kelompok.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Kelompok
        </a>
    </div>

    <table class="w-full border text-left text-sm">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="p-2">Nama Kelompok</th>
                <th class="p-2">Anggota</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelompok as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->nama_kelompok }}</td>
                <td class="p-2">
                    <ul class="list-disc pl-4">
                        @foreach ($item->anggota as $anggota)
                            <li>{{ $anggota }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="p-2 flex space-x-2">
                    <a href="{{ route('kelompok.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('kelompok.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus?')">
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
