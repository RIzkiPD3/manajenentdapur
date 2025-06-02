@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Menu</h1>
        <a href="{{ route('menus.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Menu
        </a>
    </div>

    <table class="w-full border text-left text-sm">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="p-2">Tanggal</th>
                <th class="p-2">Nama Menu</th>
                <th class="p-2">Resep</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
            <tr class="border-t">
                <td class="p-2">{{ $menu->tanggal }}</td>
                <td class="p-2">{{ $menu->nama_menu }}</td>
                <td class="p-2">{{ Str::limit($menu->resep, 50) }}</td>
                <td class="p-2 flex space-x-2">
                    <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
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
