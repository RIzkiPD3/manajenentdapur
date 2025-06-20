@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Jadwal</h2>

    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Hari</label>
            <input type="text" name="hari" value="{{ $jadwal->hari }}" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Kelompok Piket</label>
            <select name="kelompok_piket_id" class="w-full border px-3 py-2 rounded">
                @foreach ($kelompok as $item)
                    <option value="{{ $item->id }}" {{ $jadwal->kelompok_piket_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kelompok }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.jadwal.index') }}" class="text-gray-600 hover:underline">Kembali</a>
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
