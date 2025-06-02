@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Sesi Absensi</h1>

    <form action="{{ route('sesi-absensi.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label>Nama Sesi</label>
            <select name="nama_sesi" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Sesi --</option>
                <option value="Pagi">Pagi</option>
                <option value="Siang">Siang</option>
                <option value="Malam">Malam</option>
            </select>
        </div>

        <div>
            <label>Tanggal</label>
            <input type="date" name="tanggal" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label>Waktu Mulai</label>
            <input type="time" name="waktu_mulai" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('sesi-absensi.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
@endsection
