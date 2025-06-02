@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Kelompok Piket</h1>

    <form action="{{ route('kelompok.update', $kelompok->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Kelompok</label>
            <input type="text" name="nama_kelompok" value="{{ $kelompok->nama_kelompok }}"
                   required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Anggota (Pisahkan dengan koma)</label>
            <input type="text" name="anggota" value="{{ implode(', ', $kelompok->anggota) }}"
                   required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('kelompok.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
@endsection
