<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Dapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-4 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute -top-4 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
    </div>

    <!-- Main Container -->
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-white/20 transform hover:scale-105 transition-all duration-300">
                <!-- Logo/Icon -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl mb-4 shadow-lg">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Manajemen Dapur
                    </h1>
                    <p class="text-gray-600 mt-2">Kelola dapur Anda dengan mudah dan efisien</p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="text-center p-3 rounded-xl bg-blue-50 border border-blue-100">
                        <i class="fas fa-box text-blue-500 text-xl mb-2"></i>
                        <p class="text-xs text-gray-600 font-medium">Inventori</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-green-50 border border-green-100">
                        <i class="fas fa-chart-line text-green-500 text-xl mb-2"></i>
                        <p class="text-xs text-gray-600 font-medium">Laporan</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-purple-50 border border-purple-100">
                        <i class="fas fa-users text-purple-500 text-xl mb-2"></i>
                        <p class="text-xs text-gray-600 font-medium">Tim</p>
                    </div>
                </div>

                <!-- Login Button -->
                <div class="space-y-4">
                    <a href="{{ url('/login') }}"
                       class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center group">
                        <i class="fas fa-sign-in-alt mr-2 group-hover:translate-x-1 transition-transform"></i>
                        Masuk ke Dashboard
                    </a>

                    <!-- Register Link (Optional) -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ url('/register') }}" class="text-indigo-600 hover:text-indigo-700 font-medium hover:underline">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="flex items-center justify-center space-x-6 text-xs text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt mr-1"></i>
                            <span>Aman</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-1"></i>
                            <span>24/7</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-mobile-alt mr-1"></i>
                            <span>Responsive</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center hover:bg-white/80 transition-all duration-300">
                    <i class="fas fa-mobile-alt text-indigo-500 text-lg mb-2"></i>
                    <p class="text-xs font-medium text-gray-700">Mobile Friendly</p>
                </div>
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center hover:bg-white/80 transition-all duration-300">
                    <i class="fas fa-cloud text-purple-500 text-lg mb-2"></i>
                    <p class="text-xs font-medium text-gray-700">Cloud Storage</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Animations -->
    <style>
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        /* Custom scrollbar untuk halaman jika diperlukan */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #6366f1, #8b5cf6);
            border-radius: 10px;
        }
    </style>

    <!-- Optional: Add some JavaScript for enhanced interactions -->
    <script>
        // Add floating animation to the main card
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.bg-white\\/80');
            if (card) {
                card.classList.add('float');
            }
        });
    </script>
</body>
</html>