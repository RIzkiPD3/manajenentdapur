@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Absensi Petugas Hari Ini</h1>

    @if ($sesi->isEmpty() || !$kelompok)
        <div class="text-red-600">Belum ada jadwal atau sesi hari ini.</div>
    @else
        @foreach ($sesi as $item)
        <div class="bg-white shadow rounded p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">
                Sesi: {{ $item->nama_sesi }} ({{ $item->waktu_mulai }}) - {{ $item->tanggal }}
            </h2>

            <form action="{{ url('/petugas/absensi/' . $item->id) }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="kelompok_piket_id" value="{{ $kelompok->id }}">

                @foreach ($kelompok->anggota as $anggota)
                <div class="flex items-center gap-4">
                    <label class="flex-1">{{ $anggota }}</label>
                    <input type="hidden" name="absensi[{{ $loop->index }}][nama_petugas]" value="{{ $anggota }}">
                    <input type="checkbox" name="absensi[{{ $loop->index }}][status_hadir]" value="1" class="w-5 h-5">
                </div>
                @endforeach

                <div class="pt-4">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Simpan Absensi
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    @endif
@endsection
