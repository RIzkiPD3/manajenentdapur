<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Manajemen Dapur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form-input:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .btn-primary {
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="bg-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Daftar Angkatan Baru</h1>
            <p class="text-gray-600">Lengkapi data untuk mendaftarkan angkatan baru</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form id="registerForm" class="space-y-5">
                <!-- Nama Angkatan -->
                <div>
                    <label for="namaAngkatan" class="block text-sm font-medium text-gray-700 mb-2">Nama Angkatan</label>
                    <input
                        type="text"
                        id="namaAngkatan"
                        name="namaAngkatan"
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500"
                        placeholder="Contoh: Angkatan 2024"
                        required
                    >
                </div>

                <!-- Tahun Angkatan -->
                <div>
                    <label for="tahunAngkatan" class="block text-sm font-medium text-gray-700 mb-2">Tahun Angkatan</label>
                    <select
                        id="tahunAngkatan"
                        name="tahunAngkatan"
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900"
                        required
                    >
                        <option value="">Pilih Tahun</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                    </select>
                </div>

                <!-- Jumlah Kelompok -->
                <div>
                    <label for="jumlahKelompok" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Kelompok</label>
                    <input
                        type="number"
                        id="jumlahKelompok"
                        name="jumlahKelompok"
                        min="1"
                        max="20"
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500"
                        placeholder="Masukkan jumlah kelompok"
                        required
                    >
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="3"
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 resize-none"
                        placeholder="Tambahkan deskripsi singkat..."
                    ></textarea>
                </div>

                <!-- Status Aktif -->
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="statusAktif"
                        name="statusAktif"
                        checked
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    >
                    <label for="statusAktif" class="ml-2 text-sm text-gray-700">
                        Aktifkan angkatan ini
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="btn-primary w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                >
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Daftar Angkatan
                </button>

                <!-- Cancel Button -->
                <button
                    type="button"
                    onclick="goBack()"
                    class="w-full bg-gray-100 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 transition-colors duration-200"
                >
                    Kembali ke Dashboard
                </button>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Sudah terdaftar?
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Lihat Daftar Angkatan</a>
            </p>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center px-4">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full">
            <div class="text-center">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Berhasil Didaftarkan!</h3>
                <p class="text-gray-600 mb-4">Angkatan baru telah berhasil didaftarkan ke sistem.</p>
                <button
                    onclick="closeModal()"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-green-700 transition-colors duration-200"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        function closeModal() {
            document.getElementById('successModal').classList.add('hidden');
            document.getElementById('successModal').classList.remove('flex');
            document.getElementById('registerForm').reset();
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Simulate form submission
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            console.log('Data yang akan dikirim:', data);

            // Show success modal
            document.getElementById('successModal').classList.remove('hidden');
            document.getElementById('successModal').classList.add('flex');
        });

        // Auto-generate nama angkatan when tahun is selected
        document.getElementById('tahunAngkatan').addEventListener('change', function() {
            const tahun = this.value;
            const namaInput = document.getElementById('namaAngkatan');

            if (tahun && !namaInput.value) {
                namaInput.value = `Angkatan ${tahun}`;
            }
        });
    </script>
</body>
</html>