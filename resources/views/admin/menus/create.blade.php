@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Menu</h1>

    <form action="{{ route('menus.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label>Tanggal</label>
            <input type="date" name="tanggal" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Resep</label>
            <textarea name="resep" rows="5" required class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('menus.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
@endsection
