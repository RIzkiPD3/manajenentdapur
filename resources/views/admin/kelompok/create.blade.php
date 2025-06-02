@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Kelompok Piket</h1>

    <form action="{{ route('kelompok.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label>Nama Kelompok</label>
            <input type="text" name="nama_kelompok" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Anggota (Pisahkan dengan koma)</label>
            <input type="text" name="anggota" placeholder="Budi, Amin, Hasan"
                   required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('kelompok.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
@endsection
