@extends('layouts.petugas')

@section('title', 'Riwayat Request Nampan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Riwayat Request Nampan</h1>
                <p class="text-gray-600 mt-2">Kelola semua riwayat permintaan nampan dari santri</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('petugas.nampan.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    Request Aktif
                </a>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Total Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Request</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $requests->count() }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Nampan Requested -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Nampan</p>
                    <p class="text-2xl font-bold text-green-600">{{ $requests->sum('jumlah_nampan') }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Bulan Ini</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $thisMonthCount }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">Cari Request</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                           placeholder="Cari nama santri atau keterangan..."
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                </div>
            </div>
            <div class="sm:w-48">
                <label for="dateFilter" class="block text-sm font-medium text-gray-700 mb-2">Filter Tanggal</label>
                <select id="dateFilter"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Tanggal</option>
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Request</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Santri</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="requestTable">
                    @forelse($requests as $index => $request)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 request-row"
                            data-search="{{ strtolower($request->user->name . ' ' . ($request->keterangan ?? '')) }}"
                            data-date="{{ $request->created_at->format('Y-m-d') }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-sm">
                                            <span class="text-sm font-bold text-white">
                                                {{ strtoupper(substr($request->user->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $request->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    {{ $request->jumlah_nampan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="max-w-xs truncate" title="{{ $request->keterangan }}">
                                    {{ $request->keterangan ?: 'Tidak ada keterangan' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="font-medium">{{ $request->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $request->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div class="max-w-xs truncate" title="{{ $request->catatan_petugas }}">
                                    {{ $request->catatan_petugas ?: 'Belum ada catatan' }}
                                </div>
                                @if($request->processed_at)
                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ $request->processed_at->format('d/m/Y H:i') }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <button onclick="openDetailModal({{ json_encode($request) }})"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-1 rounded hover:bg-blue-50"
                                            title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>

                                    <form action="{{ route('petugas.nampan.destroy', $request->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus request ini?')"
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1 rounded hover:bg-red-50"
                                                title="Hapus Request">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada riwayat request</h3>
                                    <p class="text-gray-500">Riwayat request nampan akan muncul di sini setelah santri mengajukan permintaan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-25 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border-0 w-11/12 md:w-2/3 lg:w-1/2 shadow-2xl rounded-2xl bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900">Detail Request Nampan</h3>
                <button onclick="closeDetailModal()"
                        class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div id="modalContent" class="space-y-4">
                <!-- Content akan diisi dengan JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
// Filter functionality
document.getElementById('searchInput').addEventListener('input', filterTable);
document.getElementById('dateFilter').addEventListener('change', filterTable);

function filterTable() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const dateFilter = document.getElementById('dateFilter').value;
    const rows = document.querySelectorAll('.request-row');

    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];

    // Calculate week start (Monday)
    const weekStart = new Date(today);
    weekStart.setDate(today.getDate() - today.getDay() + 1);
    const weekStartStr = weekStart.toISOString().split('T')[0];

    // Calculate month start
    const monthStart = new Date(today.getFullYear(), today.getMonth(), 1);
    const monthStartStr = monthStart.toISOString().split('T')[0];

    rows.forEach(row => {
        const searchData = row.getAttribute('data-search');
        const requestDate = row.getAttribute('data-date');

        const matchesSearch = searchData.includes(searchTerm);

        let matchesDate = true;
        if (dateFilter === 'today') {
            matchesDate = requestDate === todayStr;
        } else if (dateFilter === 'week') {
            matchesDate = requestDate >= weekStartStr;
        } else if (dateFilter === 'month') {
            matchesDate = requestDate >= monthStartStr;
        }

        row.style.display = (matchesSearch && matchesDate) ? '' : 'none';
    });
}

// Modal functions
function openDetailModal(request) {
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('modalContent');

    // Format tanggal
    const createdDate = new Date(request.created_at).toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });

    const processedDate = request.processed_at ?
        new Date(request.processed_at).toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        }) : null;

    content.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Informasi Santri</h4>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-sm">${request.user.name.substring(0, 2).toUpperCase()}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">${request.user.name}</p>
                                <p class="text-sm text-gray-500">${request.user.email}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Detail Request</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Nampan:</span>
                            <span class="font-medium">${request.jumlah_nampan} buah</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Request:</span>
                            <span class="font-medium">${createdDate}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Keterangan</h4>
                    <p class="text-gray-700 leading-relaxed">${request.keterangan || 'Tidak ada keterangan'}</p>
                </div>

                ${request.catatan_petugas || processedDate ? `
                <div class="bg-orange-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Catatan Petugas</h4>
                    <p class="text-gray-700 leading-relaxed mb-2">${request.catatan_petugas || 'Belum ada catatan'}</p>
                    ${processedDate ? `<p class="text-sm text-gray-500">Diproses pada: ${processedDate}</p>` : ''}
                </div>
                ` : ''}
            </div>
        </div>
    `;

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('detailModal').classList.contains('hidden')) {
        closeDetailModal();
    }
});
</script>
@endsection