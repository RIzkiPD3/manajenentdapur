<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Manajemen Dapur') }} - Admin</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <div x-data="{ open: false }" class="md:block md:w-64 bg-white shadow-md fixed inset-y-0 left-0 transform md:translate-x-0"
         :class="{'translate-x-0': open, '-translate-x-full': !open}"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">

        <div class="p-5 border-b">
            <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
        </div>

        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('menus.index') }}" class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('menus.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                        Manajemen Menu
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelompok.index') }}" class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('kelompok.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                        Kelompok Piket
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwal.index') }}" class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('jadwal.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                        Jadwal Piket
                    </a>
                </li>
                <li>
                    <a href="{{ route('sesi-absensi.index') }}" class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('sesi-absensi.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                        Sesi Absensi
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 px-4 hover:bg-red-50 rounded text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Mobile Menu Toggle -->
    <button @click="open = !open" class="md:hidden fixed top-4 left-4 z-50 bg-blue-500 text-white p-2 rounded">
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Main Content -->
    <main class="flex-1 md:ml-64 p-4 md:p-8 mt-16 md:mt-0">
        @yield('content')
    </main>
</body>
</html>
