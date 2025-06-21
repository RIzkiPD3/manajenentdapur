@extends('layouts.petugas')
@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Jadwal Piket</h1>
            <p class="text-lg text-gray-600">{{ $hari }}</p>
        </div>

        @if(session('message'))
            <!-- No Schedule Message -->
            <div class="bg-white rounded-lg shadow-sm border p-8 text-center">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Jadwal</h2>
                <p class="text-gray-600">{{ $message }}</p>
            </div>
        @else
            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-sm border mb-6">
                <!-- Header -->
                <div class="bg-blue-500 px-6 py-4 rounded-t-lg">
                    <h2 class="text-xl font-semibold text-white">{{ $kelompok->nama_kelompok ?? 'Tidak Ada Kelompok' }}</h2>
                    <p class="text-blue-100 text-sm">Kelompok Piket Hari Ini</p>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Daftar Anggota</h3>

                    @if($kelompok && $kelompok->anggota)
                        @forelse ($kelompok->anggota as $index => $anggota)
                            <div class="flex items-center p-4 mb-3 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-medium text-sm">{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium">{{ $anggota }}</p>
                                </div>
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Anggota</h3>
                                <p class="text-gray-500">Belum ada anggota yang terdaftar dalam kelompok ini.</p>
                            </div>
                        @endforelse
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Anggota</h3>
                            <p class="text-gray-500">Belum ada anggota yang terdaftar dalam kelompok ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-3 rounded-b-lg border-t">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Diperbarui: {{ now()->format('d M Y, H:i') }}</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            Aktif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Menu Hari Ini Card -->
            <div class="bg-white rounded-lg shadow-sm border">
                <!-- Header -->
                <div class="bg-orange-500 px-6 py-4 rounded-t-lg">
                    <h2 class="text-xl font-semibold text-white">Menu Hari Ini</h2>
                    <p class="text-orange-100 text-sm">Daftar Menu yang Tersedia</p>
                </div>

                <!-- Content -->
                <div class="p-6">
                    @if($menuHariIni && $menuHariIni->count() > 0)
                        <div class="space-y-4">
                            @foreach($menuHariIni as $menu)
                                <div class="flex items-center p-4 bg-orange-50 rounded-lg border border-orange-100">
                                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $menu->nama_menu }}</h4>
                                        <p class="text-sm text-gray-600">{{ ucfirst($menu->sesi) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-700">
                                            {{ ucfirst($menu->sesi) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Menu</h3>
                            <p class="text-gray-500">Belum ada menu yang diatur untuk hari ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-3 rounded-b-lg border-t">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Menu untuk: {{ now()->format('d M Y') }}</span>
                        <span class="text-gray-500">{{ $menuHariIni ? $menuHariIni->count() : 0 }} item</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@if($kelompok)
<script>
function tandaiSelesai() {
    if (confirm('Apakah Anda yakin ingin menandai tugas piket hari ini sebagai selesai?')) {
        fetch('/petugas/jadwal/tandai-selesai', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                kelompok_id: {{ $kelompok->id }},
                tanggal: '{{ now()->format("Y-m-d") }}',
                catatan: 'Tugas piket telah diselesaikan'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menandai tugas selesai');
        });
    }
}
</script>
@endif
@endsection