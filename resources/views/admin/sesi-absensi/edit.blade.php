@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Sesi Absensi</h1>

    <form action="{{ route('sesi-absensi.update', $sesi->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Sesi</label>
            <select name="nama_sesi" required class="w-full border px-3 py-2 rounded">
                <option value="Pagi" {{ $sesi->nama_sesi === 'Pagi' ? 'selected' : '' }}>Pagi</option>
                <option value="Siang" {{ $sesi->nama_sesi === 'Siang' ? 'selected' : '' }}>Siang</option>
                <option value="Malam" {{ $sesi->nama_sesi === 'Malam' ? 'selected' : '' }}>Malam</option>
            </select>
        </div>

        <div>
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $sesi->tanggal }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Waktu Mulai</label>
            <input type="time" name="waktu_mulai" value="{{ $sesi->waktu_mulai }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('sesi-absensi.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
@endsection
