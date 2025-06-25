@extends('layouts.petugas')

@section('title', 'Riwayat Request Nampan')
@section('page-title', 'Riwayat Request')
@section('page-description', 'Kelola semua riwayat permintaan nampan dari santri')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Riwayat Request Nampan</h1>
                <p class="text-slate-600 mt-2">Kelola semua riwayat permintaan nampan dari santri</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('petugas.request-nampan') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-200">
                    <i class="fa-solid fa-plus w-4 h-4 mr-2"></i>
                    Request Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <i class="fa-solid fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <i class="fa-solid fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Total Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Total Request</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $requests->count() }}</p>
                </div>
                <div class="p-3 bg-orange-100 rounded-full">
                    <i class="fa-solid fa-clipboard-list text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Nampan Requested -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Total Nampan</p>
                    <p class="text-2xl font-bold text-green-600">{{ $requests->sum('jumlah_nampan') }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fa-solid fa-utensils text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Bulan Ini</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $thisMonthCount }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fa-solid fa-calendar-days text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="searchInput" class="block text-sm font-medium text-slate-700 mb-2">Cari Request</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-slate-400"></i>
                    </div>
                    <input type="text" id="searchInput"
                           placeholder="Cari nama santri atau keterangan..."
                           class="block w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                </div>
            </div>
            <div class="sm:w-48">
                <label for="dateFilter" class="block text-sm font-medium text-slate-700 mb-2">Filter Tanggal</label>
                <select id="dateFilter"
                        class="block w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Tanggal</option>
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-semibold text-slate-800">Daftar Request</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Santri</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Jumlah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Keterangan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Catatan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200" id="requestTable">
                    @forelse($requests as $index => $request)
                        <tr class="hover:bg-slate-50 transition-colors duration-150 request-row"
                            data-search="{{ strtolower($request->user->name . ' ' . ($request->keterangan ?? '')) }}"
                            data-date="{{ $request->created_at->format('Y-m-d') }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
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
                                        <div class="text-sm font-medium text-slate-800">{{ $request->user->name }}</div>
                                        <div class="text-sm text-slate-500">{{ $request->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800 border border-cyan-200">
                                    <i class="fa-solid fa-utensils mr-1"></i>
                                    {{ $request->jumlah_nampan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-800">
                                <div class="max-w-xs truncate" title="{{ $request->keterangan }}">
                                    {{ $request->keterangan ?: 'Tidak ada keterangan' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <div class="font-medium text-slate-800">{{ $request->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-slate-500">{{ $request->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <div class="max-w-xs truncate" title="{{ $request->catatan_petugas }}">
                                    {{ $request->catatan_petugas ?: 'Belum ada catatan' }}
                                </div>
                                @if($request->processed_at)
                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $request->processed_at->format('d/m/Y H:i') }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <button onclick="openDetailModal({{ json_encode($request) }})"
                                            class="text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition-colors duration-200 p-2 rounded-lg"
                                            title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-clipboard-list text-slate-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-slate-800 mb-2">Belum ada riwayat request</h3>
                                    <p class="text-slate-500">Riwayat request nampan akan muncul di sini setelah santri mengajukan permintaan</p>
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
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-slate-200">
                <h3 class="text-xl font-bold text-slate-800">Detail Request Nampan</h3>
                <button onclick="closeDetailModal()"
                        class="text-slate-400 hover:text-slate-600 transition-colors duration-200 p-1 rounded-full hover:bg-slate-100">
                    <i class="fa-solid fa-times text-lg"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div id="modalContent" class="space-y-4">
                <!-- Content akan diisi dengan JavaScript -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
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
                <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                    <h4 class="font-semibold text-slate-800 mb-3 flex items-center">
                        <i class="fa-solid fa-user mr-2 text-blue-600"></i>
                        Informasi Santri
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-sm">${request.user.name.substring(0, 2).toUpperCase()}</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-800">${request.user.name}</p>
                                <p class="text-sm text-slate-500">${request.user.email}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                    <h4 class="font-semibold text-slate-800 mb-3 flex items-center">
                        <i class="fa-solid fa-clipboard-list mr-2 text-orange-600"></i>
                        Detail Request
                    </h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Jumlah Nampan:</span>
                            <span class="font-medium text-slate-800">${request.jumlah_nampan} buah</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Tanggal Request:</span>
                            <span class="font-medium text-slate-800">${createdDate}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <h4 class="font-semibold text-slate-800 mb-3 flex items-center">
                        <i class="fa-solid fa-comment mr-2 text-green-600"></i>
                        Keterangan
                    </h4>
                    <p class="text-slate-700 leading-relaxed">${request.keterangan || 'Tidak ada keterangan'}</p>
                </div>

                ${request.catatan_petugas || processedDate ? `
                <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                    <h4 class="font-semibold text-slate-800 mb-3 flex items-center">
                        <i class="fa-solid fa-clipboard-check mr-2 text-purple-600"></i>
                        Catatan Petugas
                    </h4>
                    <p class="text-slate-700 leading-relaxed mb-2">${request.catatan_petugas || 'Belum ada catatan'}</p>
                    ${processedDate ? `<p class="text-sm text-slate-500">Diproses pada: ${processedDate}</p>` : ''}
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
@endpush
@endsection