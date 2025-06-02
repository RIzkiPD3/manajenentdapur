@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Request Nampan</h1>

    @if (!$kelompok)
        <div class="text-red-600">Tidak ada kelompok piket bertugas hari ini.</div>
    @else
        <form action="{{ url('/angkatan/request-nampan') }}" method="POST" class="space-y-4 max-w-md">
            @csrf
            <input type="hidden" name="kelompok_piket_id" value="{{ $kelompok->id }}">
            <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">

            <div>
                <label for="jumlah_nampan">Jumlah Nampan</label>
                <input type="number" name="jumlah_nampan" min="1" required class="w-full border px-3 py-2 rounded">
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Kirim Request
                </button>
            </div>
        </form>
    @endif
@endsection
