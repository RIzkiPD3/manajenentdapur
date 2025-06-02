@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Jadwal Piket</h1>

    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Kelompok Piket</label>
            <select name="kelompok_piket_id" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $item)
                    <option value="{{ $item->id }}" @if($jadwal->kelompok_piket_id == $item->id) selected @endif>
                        {{ $item->nama_kelompok }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('jadwal.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
@endsection
