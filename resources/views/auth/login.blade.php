<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemen Dapur</title>
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
                        <i class="fas fa-sign-in-alt text-white text-xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">
                        Masuk
                    </h1>
                    <p class="text-slate-600">Silakan masuk ke akun Anda</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ url('/login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-slate-400"></i>
                            </div>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   required
                                   class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-slate-50 focus:bg-white"
                                   placeholder="Masukkan email Anda">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-slate-400"></i>
                            </div>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   required
                                   class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-slate-50 focus:bg-white"
                                   placeholder="Masukkan password Anda">
                        </div>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-red-400 mt-0.5 mr-3"></i>
                                <div class="flex-1">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-sm text-red-700 mb-1 last:mb-0">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-orange-500 focus:ring-orange-500 border-slate-300 rounded">
                        <label for="remember" class="ml-2 text-sm text-slate-600">Ingat saya</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-slate-800 hover:bg-slate-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group">
                        <i class="fas fa-sign-in-alt mr-3 group-hover:translate-x-1 transition-transform"></i>
                        Masuk ke Dashboard
                    </button>
                </form>

                <!-- Back to Welcome -->
                <div class="mt-6 pt-6 border-t border-slate-200 text-center">
                    <a href="{{ url('/') }}" class="text-sm text-slate-500 hover:text-slate-700 transition-colors flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>