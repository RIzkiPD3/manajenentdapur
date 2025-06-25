@extends('layouts.admin')

@section('title', 'Tambah Angkatan - Admin Panel')
@section('page-title', 'Tambah Angkatan')
@section('page-description', 'Buat akun baru untuk angkatan')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-user-plus text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Form Tambah Angkatan</h3>
                    <p class="text-sm text-slate-600">Lengkapi informasi untuk membuat akun angkatan baru</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <form action="{{ route('admin.angkatan.store') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-6">
                <!-- Nama Field -->
                <div>
                    <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fa-solid fa-user text-slate-500 mr-2"></i>
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="nama"
                               name="nama"
                               value="{{ old('nama') }}"
                               required
                               placeholder="Masukkan nama lengkap"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white @error('nama') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
                        @error('nama')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-exclamation-circle text-red-500"></i>
                            </div>
                        @enderror
                    </div>
                    @error('nama')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <i class="fa-solid fa-exclamation-triangle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fa-solid fa-envelope text-slate-500 mr-2"></i>
                        Alamat Email
                    </label>
                    <div class="relative">
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               placeholder="nama@example.com"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
                        @error('email')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-exclamation-circle text-red-500"></i>
                            </div>
                        @enderror
                    </div>
                    @error('email')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <i class="fa-solid fa-exclamation-triangle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Fields Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fa-solid fa-lock text-slate-500 mr-2"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   required
                                   placeholder="Masukkan password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
                            <button type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('password')">
                                <i class="fa-solid fa-eye text-slate-400 hover:text-slate-600" id="password-toggle"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="fa-solid fa-exclamation-triangle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fa-solid fa-lock-keyhole text-slate-500 mr-2"></i>
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   required
                                   placeholder="Ulangi password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 focus:bg-white">
                            <button type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('password_confirmation')">
                                <i class="fa-solid fa-eye text-slate-400 hover:text-slate-600" id="password_confirmation-toggle"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Password Requirements Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fa-solid fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-800 mb-1">Persyaratan Password:</h4>
                            <ul class="text-sm text-blue-700 space-y-1">
                                <li>• Minimal 8 karakter</li>
                                <li>• Kombinasi huruf besar dan kecil</li>
                                <li>• Mengandung angka dan simbol</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-8 mt-8 border-t border-gray-200">
                <a href="{{ route('admin.angkatan.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 transition-colors font-medium">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Kembali
                </a>

                <div class="flex space-x-3">
                    <button type="reset"
                            class="inline-flex items-center px-6 py-3 border border-slate-300 rounded-lg text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-400 transition-colors font-medium">
                        <i class="fa-solid fa-refresh mr-2"></i>
                        Reset
                    </button>

                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors font-medium shadow-sm hover:shadow-md">
                        <i class="fa-solid fa-save mr-2"></i>
                        Simpan Angkatan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const toggle = document.getElementById(fieldId + '-toggle');

    if (field.type === 'password') {
        field.type = 'text';
        toggle.classList.remove('fa-eye');
        toggle.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        toggle.classList.remove('fa-eye-slash');
        toggle.classList.add('fa-eye');
    }
}

// Form validation feedback
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');

    function validatePasswordMatch() {
        if (password.value && confirmPassword.value) {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Password tidak cocok');
                confirmPassword.classList.add('border-red-500');
            } else {
                confirmPassword.setCustomValidity('');
                confirmPassword.classList.remove('border-red-500');
                confirmPassword.classList.add('border-green-500');
            }
        }
    }

    password.addEventListener('input', validatePasswordMatch);
    confirmPassword.addEventListener('input', validatePasswordMatch);

    // Auto-focus first empty field
    const firstEmptyField = form.querySelector('input:not([value]):not([type="password"])');
    if (firstEmptyField) {
        firstEmptyField.focus();
    }
});
</script>
@endsection