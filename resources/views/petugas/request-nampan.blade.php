@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Permintaan Nampan Hari Ini</h1>

    @if ($requests->isEmpty())
        <p class="text-gray-600">Belum ada request masuk.</p>
    @else
        <table class="w-full border text-left text-sm">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-2">Angkatan</th>
                    <th class="p-2">Jumlah Nampan</th>
                    <th class="p-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $req)
                <tr class="border-t">
                    <td class="p-2">{{ $req->user->name ?? 'Tidak diketahui' }}</td>
                    <td class="p-2">{{ $req->jumlah_nampan }}</td>
                    <td class="p-2">{{ $req->tanggal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
