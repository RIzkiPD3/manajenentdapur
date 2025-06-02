@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Jadwal Piket</h1>

    <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label>Tanggal</label>
            <input type="date" name="tanggal" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Kelompok Piket</label>
            <select name="kelompok_piket_id" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kelompok }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('jadwal.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
@endsection
