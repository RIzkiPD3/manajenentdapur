@extends('layouts.petugas')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Request Nampan</h1>
                    <p class="text-gray-600 mt-2">Kelola permintaan nampan dari angkatan</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('petugas.nampan.riwayat') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-200">
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
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Request</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $requests->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $requests->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Approved</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $requests->where('status', 'approved')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rejected</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $requests->where('status', 'rejected')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Request Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Request Nampan</h2>
            </div>

            @forelse($requests as $request)
                <div class="border-b border-gray-100 last:border-b-0">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium text-sm">{{ substr($request->user->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">{{ $request->user->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $request->user->email }}</p>
                                    </div>
                                    <div class="ml-auto">
                                        @if($request->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @elseif($request->status === 'approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                        @elseif($request->status === 'rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Rejected
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"></path>
                                        </svg>
                                        <span class="font-medium">Jumlah Nampan:</span>
                                        <span class="ml-1 font-semibold text-gray-900">{{ $request->jumlah_nampan }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 6v6m-7-3h14a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium">Tanggal:</span>
                                        <span class="ml-1">{{ $request->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>

                                @if($request->keterangan)
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-700 mb-1">Keterangan:</p>
                                        <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">{{ $request->keterangan }}</p>
                                    </div>
                                @endif

                                @if($request->catatan_petugas)
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-700 mb-1">Catatan Petugas:</p>
                                        <p class="text-sm text-gray-600 bg-blue-50 p-3 rounded-lg">{{ $request->catatan_petugas }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if($request->status === 'pending')
                            <div class="flex items-center justify-end space-x-3 mt-4 pt-4 border-t border-gray-100">
                                <button onclick="openUpdateModal({{ $request->id }}, '{{ $request->user->name }}', {{ $request->jumlah_nampan }})"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Update Status
                                </button>
                                <form action="{{ route('petugas.nampan.destroy', $request->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus request ini?')"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200">
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
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada request nampan</h3>
                    <p class="text-gray-500">Request nampan dari angkatan akan muncul di sini</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Update Status Request</h3>
                <button onclick="closeUpdateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="updateForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Request dari: <span id="modalUserName" class="font-medium"></span></p>
                    <p class="text-sm text-gray-600">Jumlah nampan: <span id="modalJumlah" class="font-medium"></span></p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Petugas (Opsional)</label>
                    <textarea name="catatan_petugas" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Berikan catatan jika diperlukan..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeUpdateModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
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