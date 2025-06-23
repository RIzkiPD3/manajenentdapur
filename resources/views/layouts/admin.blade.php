<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Manajemen Dapur')</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans">

<div class="flex min-h-screen">

    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-slate-800 shadow-lg fixed md:relative min-h-screen z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="p-6 space-y-6 min-h-screen flex flex-col">
            <!-- Logo & Title -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-utensils text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                    <p class="text-sm text-slate-300">Manajemen Dapur</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2 flex-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center space-x-3 px-4 py-3 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-orange-400 transition-colors group {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-orange-400' : '' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center group-hover:text-orange-400 {{ request()->routeIs('admin.dashboard') ? 'text-orange-400' : '' }}"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.menus.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-green-400 transition-colors group {{ request()->routeIs('admin.menus.*') ? 'bg-slate-700 text-green-400' : '' }}">
                    <i class="fa-solid fa-utensils w-5 text-center group-hover:text-green-400 {{ request()->routeIs('admin.menus.*') ? 'text-green-400' : '' }}"></i>
                    <span class="font-medium">Menu</span>
                </a>

                <a href="{{ route('admin.kelompok.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-blue-400 transition-colors group {{ request()->routeIs('admin.kelompok.*') ? 'bg-slate-700 text-blue-400' : '' }}">
                    <i class="fa-solid fa-users w-5 text-center group-hover:text-blue-400 {{ request()->routeIs('admin.kelompok.*') ? 'text-blue-400' : '' }}"></i>
                    <span class="font-medium">Kelompok</span>
                </a>

                <a href="{{ route('admin.jadwal.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition-colors group {{ request()->routeIs('admin.jadwal.*') ? 'bg-slate-700 text-purple-400' : '' }}">
                    <i class="fa-solid fa-calendar-days w-5 text-center group-hover:text-purple-400 {{ request()->routeIs('admin.jadwal.*') ? 'text-purple-400' : '' }}"></i>
                    <span class="font-medium">Jadwal</span>
                </a>

                <a href="{{ route('admin.sesi-absensi.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-cyan-400 transition-colors group {{ request()->routeIs('admin.sesi-absensi.*') ? 'bg-slate-700 text-cyan-400' : '' }}">
                    <i class="fa-solid fa-clipboard-check w-5 text-center group-hover:text-cyan-400 {{ request()->routeIs('admin.sesi-absensi.*') ? 'text-cyan-400' : '' }}"></i>
                    <span class="font-medium">Sesi Absensi</span>
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="mt-auto space-y-4">
                <!-- User Info -->
                <div class="pt-6 border-t border-slate-600">
                    <div class="flex items-center space-x-3 px-4 py-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin User' }}</p>
                            <p class="text-xs text-slate-400">Administrator</p>
                        </div>
                    </div>
                </div>

                <!-- Logout Button -->
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-50">
        <!-- Header Bar -->
        <div class="bg-white shadow-sm border-b border-gray-200 px-4 md:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Hamburger Menu (Mobile) -->
                    <button id="hamburger-btn" class="md:hidden p-2 text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>

                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-slate-600 text-sm">@yield('page-description', 'Kelola sistem manajemen dapur')</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Date -->
                    <div class="text-sm text-slate-600 bg-slate-100 px-3 py-2 rounded-lg hidden sm:block">
                        <span id="current-date">{{ date('d M Y') }}</span>
                    </div>

                    <!-- Time -->
                    <div class="text-sm text-slate-600 bg-slate-100 px-3 py-2 rounded-lg">
                        <span id="current-time">{{ date('H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-4 md:p-8">
            @if(session('success'))
                <div class="max-w-7xl mx-auto mb-6">
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto mb-6">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fa-solid fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

<script>
    // Sidebar toggle functionality
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
    }

    hamburgerBtn.addEventListener('click', toggleSidebar);
    sidebarOverlay.addEventListener('click', toggleSidebar);

    // Update current time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
        const dateString = now.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });

        const timeElement = document.getElementById('current-time');
        const dateElement = document.getElementById('current-date');

        if (timeElement) timeElement.textContent = timeString;
        if (dateElement) dateElement.textContent = dateString;
    }

    // Update time every minute
    updateTime();
    setInterval(updateTime, 60000);

    // Auto-hide flash messages
    setTimeout(function() {
        const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);
</script>

@stack('scripts')

</body>
</html>