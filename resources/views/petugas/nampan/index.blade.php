@extends('layouts.petugas')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Request Nampan</h1>
                    <p class="text-slate-600 mt-2">Kelola permintaan nampan dari angkatan</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('petugas.nampan.riwayat') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Riwayat Semua
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Total Request</p>
                        <p class="text-3xl font-bold text-slate-900">{{ $requests->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200">
                <div class="flex items-center">
                    <div class="p-3 bg-amber-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Belum Diproses</p>
                        <p class="text-3xl font-bold text-slate-900">{{ $requests->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Request Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Daftar Request Nampan</h2>
            </div>

            @forelse($requests as $request)
                <div class="border-b border-slate-100 last:border-b-0">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-violet-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-lg">{{ substr($request->user->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-slate-900">{{ $request->user->name }}</h3>
                                        <p class="text-sm text-slate-500">{{ $request->user->email }}</p>
                                    </div>
                                    <div class="ml-auto">
                                        @if($request->status === 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                                Menunggu
                                            </span>
                                        @elseif($request->status === 'approved')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                                Disetujui
                                            </span>
                                        @elseif($request->status === 'rejected')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center text-sm text-slate-600">
                                        <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-medium text-slate-700">Jumlah Nampan</span>
                                            <p class="text-lg font-bold text-slate-900">{{ $request->jumlah_nampan }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-sm text-slate-600">
                                        <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 6v6m-7-3h14a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-medium text-slate-700">Tanggal Request</span>
                                            <p class="text-sm text-slate-900">{{ $request->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($request->keterangan)
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-slate-700 mb-2">Keterangan:</p>
                                        <div class="bg-slate-50 border border-slate-200 p-3 rounded-lg">
                                            <p class="text-sm text-slate-700">{{ $request->keterangan }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($request->catatan_petugas)
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-slate-700 mb-2">Catatan Petugas:</p>
                                        <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg">
                                            <p class="text-sm text-blue-800">{{ $request->catatan_petugas }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if($request->status === 'pending')
                            <div class="flex items-center justify-end space-x-3 mt-6 pt-4 border-t border-slate-200">
                                <button onclick="openUpdateModal({{ $request->id }}, '{{ $request->user->name }}', {{ $request->jumlah_nampan }})"
                                        class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Update Status
                                </button>
                                <form action="{{ route('petugas.nampan.destroy', $request->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus request ini?')"
                                            class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Belum ada request nampan</h3>
                    <p class="text-slate-500">Request nampan dari angkatan akan muncul di sini</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div id="updateModal" class="fixed inset-0 bg-slate-900 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-xl rounded-xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-slate-900">Update Status Request</h3>
                <button onclick="closeUpdateModal()" class="text-slate-400 hover:text-slate-600 p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="updateForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6 p-4 bg-slate-50 rounded-lg">
                    <p class="text-sm text-slate-600 mb-1">Request dari: <span id="modalUserName" class="font-semibold text-slate-900"></span></p>
                    <p class="text-sm text-slate-600">Jumlah nampan: <span id="modalJumlah" class="font-semibold text-slate-900"></span></p>
                </div>

                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Catatan Petugas (Opsional)</label>
                    <textarea name="catatan_petugas" rows="3" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Berikan catatan jika diperlukan..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeUpdateModal()" class="px-5 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200 shadow-sm">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openUpdateModal(requestId, userName, jumlahNampan) {
    document.getElementById('updateModal').classList.remove('hidden');
    document.getElementById('modalUserName').textContent = userName;
    document.getElementById('modalJumlah').textContent = jumlahNampan;
    document.getElementById('updateForm').action = `/petugas/nampan/${requestId}/update-status`;
}

function closeUpdateModal() {
    document.getElementById('updateModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('updateModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeUpdateModal();
    }
});
</script>
@endsection