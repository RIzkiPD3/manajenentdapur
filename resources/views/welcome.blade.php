<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Dapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-slate-50">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, #334155 1px, transparent 0); background-size: 32px 32px;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative flex items-center justify-center min-h-screen p-6">
        <div class="w-full max-w-lg">
            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-slate-200">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-500 rounded-xl mb-4 shadow-lg">
                        <i class="fas fa-utensils text-white text-xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">
                        Manajemen Dapur
                    </h1>
                    <p class="text-slate-600">Kelola dapur Anda dengan mudah dan efisien</p>
                </div>

                <!-- Feature Icons -->
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="text-center p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                        <i class="fas fa-utensils text-orange-500 text-lg mb-2"></i>
                        <p class="text-sm text-slate-600 font-medium">Menu</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                        <i class="fas fa-users text-blue-500 text-lg mb-2"></i>
                        <p class="text-sm text-slate-600 font-medium">Kelompok</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors">
                        <i class="fas fa-calendar-days text-purple-500 text-lg mb-2"></i>
                        <p class="text-sm text-slate-600 font-medium">Jadwal</p>
                    </div>
                </div>

                <!-- Login Button -->
                <a href="{{ url('/login') }}"
                   class="w-full bg-slate-800 hover:bg-slate-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group">
                    <i class="fas fa-sign-in-alt mr-3 group-hover:translate-x-1 transition-transform"></i>
                    Masuk ke Dashboard
                </a>

                <!-- Info Footer -->
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="flex items-center justify-center space-x-8 text-sm text-slate-500">
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2 text-slate-400"></i>
                            <span>24/7 Access</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-mobile-alt mr-2 text-slate-400"></i>
                            <span>Mobile Ready</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Stats -->
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 text-center hover:shadow-lg transition-shadow">
                    <div class="w-8 h-8 bg-cyan-500 rounded-lg mx-auto mb-2 flex items-center justify-center">
                        <i class="fas fa-clipboard-check text-white text-sm"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Absensi Digital</p>
                    <p class="text-xs text-slate-500 mt-1">Tracking otomatis</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md border border-slate-200 text-center hover:shadow-lg transition-shadow">
                    <div class="w-8 h-8 bg-orange-500 rounded-lg mx-auto mb-2 flex items-center justify-center">
                        <i class="fas fa-chart-line text-white text-sm"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Laporan Real-time</p>
                    <p class="text-xs text-slate-500 mt-1">Data akurat</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>