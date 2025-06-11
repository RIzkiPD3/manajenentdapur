<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas - @yield('title', 'Manajemen Dapur')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3730a3 50%, #581c87 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }
        .nav-hover {
            transition: all 0.3s ease;
        }
        .nav-hover:hover {
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.2);
        }
        .main-gradient {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        .nav-hover.active {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(8px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-200 font-sans">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 sidebar-gradient text-white shadow-2xl relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white rounded-full"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white rounded-full"></div>
        </div>

        <div class="relative z-10 p-8 space-y-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="text-4xl mb-3">
                    <i class="fa-solid fa-user-chef"></i>
                </div>
                <h1 class="text-2xl font-bold tracking-wide">Petugas Dapur</h1>
                <div class="w-16 h-1 bg-gradient-to-r from-yellow-400 to-orange-500 mx-auto mt-2 rounded-full"></div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-3">
                <a href="{{ route('petugas.dashboard') }}"
                   class="nav-hover {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }} flex items-center space-x-4 px-4 py-3 rounded-xl text-white/90 hover:text-white group">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('petugas.jadwal') }}"
                   class="nav-hover {{ request()->routeIs('petugas.jadwal') ? 'active' : '' }} flex items-center space-x-4 px-4 py-3 rounded-xl text-white/90 hover:text-white group">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <i class="fa-solid fa-calendar-days text-sm"></i>
                    </div>
                    <span class="font-medium">Jadwal & Resep</span>
                </a>

                <a href="{{ route('petugas.absensi.index') }}"
                   class="nav-hover {{ request()->routeIs('petugas.absensi.*') ? 'active' : '' }} flex items-center space-x-4 px-4 py-3 rounded-xl text-white/90 hover:text-white group">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <i class="fa-solid fa-clipboard-check text-sm"></i>
                    </div>
                    <span class="font-medium">Absensi</span>
                </a>

                <a href="{{ route('petugas.request-nampan') }}"
                   class="nav-hover {{ request()->routeIs('petugas.request-nampan') ? 'active' : '' }} flex items-center space-x-4 px-4 py-3 rounded-xl text-white/90 hover:text-white group">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </div>
                    <span class="font-medium">Request Nampan</span>
                </a>

                <a href="{{ route('petugas.riwayat-request') }}"
                   class="nav-hover {{ request()->routeIs('petugas.riwayat-request') ? 'active' : '' }} flex items-center space-x-4 px-4 py-3 rounded-xl text-white/90 hover:text-white group">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="font-medium">Riwayat Request</span>
                </a>
            </nav>

            <!-- User Info Card -->
            <div class="glass-effect rounded-xl p-4 mt-8">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-user text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="text-white/90 font-medium text-sm">{{ auth()->user()->name ?? 'Petugas' }}</p>
                        <p class="text-white/60 text-xs">Kitchen Staff</p>
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="pt-4">
                @csrf
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-xl text-white font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 01-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 main-gradient min-h-screen">
        <!-- Content Header -->
        <div class="bg-white/50 backdrop-blur-sm border-b border-white/20 px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-gray-600 mt-1">@yield('page-description', 'Kelola operasional dapur dengan efisien')</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Notification Bell -->
                    <button class="relative p-2 text-gray-600 hover:text-gray-800 hover:bg-white/50 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Current Time -->
                    <div class="text-sm text-gray-600 bg-white/50 px-3 py-2 rounded-lg">
                        <span id="current-time"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-8">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="px-8 py-4 border-t border-white/20 bg-white/30 backdrop-blur-sm mt-auto">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">© 2024 Manajemen Dapur. All rights reserved.</p>
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span>Made with</span>
                    <i class="fa-solid fa-heart text-red-500"></i>
                    <span>Laravel & TailwindCSS</span>
                </div>
            </div>
        </footer>
    </main>

</div>

<script>
    // Update current time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;
    }

    updateTime();
    setInterval(updateTime, 60000); // Update every minute
</script>

</body>
</html>