@extends('layouts.petugas')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Menu Makanan</h1>

    @if ($menus->isEmpty())
        <div class="text-gray-600">Belum ada menu tersedia.</div>
    @else
        <div class="grid gap-6 md:grid-cols-2">
            @foreach ($menus as $menu)
                <div class="bg-white p-5 rounded shadow">
                    <h2 class="text-lg font-semibold text-indigo-700">{{ $menu->nama_menu }}</h2>
                    <h3 class="text-sm text-gray-600 mt-2 mb-1 font-medium">Bahan-bahan:</h3>
                    <ul class="list-disc pl-5 text-sm text-gray-700">
                        @foreach (explode("\n", $menu->bahan) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
