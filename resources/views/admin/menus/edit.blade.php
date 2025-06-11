@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Menu</h1>

    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $menu->tanggal }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Resep</label>
            <textarea name="resep" rows="5" required class="w-full border px-3 py-2 rounded">{{ $menu->resep }}</textarea>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.menus.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
@endsection
