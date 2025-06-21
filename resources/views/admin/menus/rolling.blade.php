@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Rolling Menu 60 Hari</h2>

    @foreach ($menus as $tanggal => $items)
        <div class="mb-4 bg-white shadow rounded p-4">
            <h4 class="font-semibold text-lg mb-2">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</h4>
            <ul class="list-disc list-inside">
                @foreach ($items as $menu)
                    <li><span class="capitalize font-semibold">{{ $menu->sesi }}</span>: {{ $menu->name }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
