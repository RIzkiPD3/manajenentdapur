<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Dapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-700 text-white flex flex-col px-4 py-6">
            <h2 class="text-2xl font-bold mb-8 text-center">Manajemen Dapur</h2>

            <nav class="flex flex-col space-y-4">
                <a href="#" class="hover:bg-indigo-600 rounded px-3 py-2">Dashboard</a>
                {{-- Tambahkan link sesuai role --}}
                <a href="#" class="hover:bg-indigo-600 rounded px-3 py-2">Menu</a>
                <a href="#" class="hover:bg-indigo-600 rounded px-3 py-2">Kelompok</a>
                <a href="#" class="hover:bg-indigo-600 rounded px-3 py-2">Jadwal</a>
                <a href="#" class="hover:bg-indigo-600 rounded px-3 py-2">Absensi</a>
            </nav>

            <form action="{{ url('/logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 mt-10 rounded">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">
            @yield('content')
        </main>
    </div>
</body>
</html>
