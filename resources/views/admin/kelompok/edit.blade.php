@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-blue-600 mb-2">
                Edit Kelompok Piket
            </h1>
            <p class="text-gray-600 text-lg">Perbarui informasi kelompok piket</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-blue-600 px-8 py-6">
                <h2 class="text-xl font-semibold text-white">Edit Informasi Kelompok</h2>
            </div>

            <form action="{{ route('admin.kelompok.update', $kelompok->id) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Nama Kelompok -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Nama Kelompok
                        </span>
                    </label>
                    <input type="text"
                           name="nama_kelompok"
                           value="{{ old('nama_kelompok', $kelompok->nama_kelompok) }}"
                           required
                           placeholder="Masukkan nama kelompok..."
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 outline-none hover:border-gray-300">
                    @error('nama_kelompok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                            Urutan Kelompok
                        </span>
                    </label>
                    <input type="number"
                           name="urutan"
                           value="{{ old('urutan', $kelompok->urutan) }}"
                           required
                           min="1"
                           placeholder="Masukkan urutan kelompok..."
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 outline-none hover:border-gray-300">
                    @error('urutan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Anggota Section -->
                <div class="space-y-4">
                    <label class="block text-sm font-semibold text-gray-700">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            Anggota Kelompok
                        </span>
                    </label>

                    <div id="anggota-container" class="space-y-3">
                        <!-- Existing members -->
                        @if(is_array($kelompok->anggota))
                            @foreach($kelompok->anggota as $index => $anggota)
                            <div class="anggota-item flex items-center space-x-3 p-4 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 hover:border-blue-300 transition-colors">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-semibold text-blue-600 member-number">{{ $index + 1 }}</span>
                                </div>
                                <input type="text"
                                       name="anggota[]"
                                       value="{{ $anggota }}"
                                       placeholder="Nama anggota..."
                                       required
                                       class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-all outline-none">
                                <button type="button"
                                        class="remove-member {{ count($kelompok->anggota) <= 1 ? 'hidden' : '' }} flex-shrink-0 w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition-colors"
                                        onclick="removeMember(this)">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        @else
                            <!-- Fallback jika anggota bukan array -->
                            <div class="anggota-item flex items-center space-x-3 p-4 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 hover:border-blue-300 transition-colors">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-semibold text-blue-600 member-number">1</span>
                                </div>
                                <input type="text"
                                       name="anggota[]"
                                       value=""
                                       placeholder="Nama anggota..."
                                       required
                                       class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-all outline-none">
                                <button type="button"
                                        class="remove-member hidden flex-shrink-0 w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition-colors"
                                        onclick="removeMember(this)">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Add Member Button -->
                    <button type="button"
                            id="add-member-btn"
                            onclick="addMember()"
                            class="w-full py-3 border-2 border-dashed border-blue-300 text-blue-600 rounded-xl hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 font-medium flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span>Tambah Anggota</span>
                    </button>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.kelompok.index') }}"
                       class="w-full sm:w-auto px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors duration-200 text-center border border-gray-200">
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </span>
                    </a>
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Kelompok
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let memberCount = {{ is_array($kelompok->anggota) ? count($kelompok->anggota) : 1 }};

function addMember() {
    memberCount++;
    const container = document.getElementById('anggota-container');

    const memberItem = document.createElement('div');
    memberItem.className = 'anggota-item flex items-center space-x-3 p-4 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 hover:border-blue-300 transition-colors animate-fade-in';

    memberItem.innerHTML = `
        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
            <span class="text-sm font-semibold text-blue-600 member-number">${memberCount}</span>
        </div>
        <input type="text"
               name="anggota[]"
               placeholder="Nama anggota..."
               required
               class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition-all outline-none">
        <button type="button"
                class="remove-member flex-shrink-0 w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition-colors"
                onclick="removeMember(this)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;

    container.appendChild(memberItem);
    updateRemoveButtons();
    updateMemberNumbers();

    // Focus on the new input
    const newInput = memberItem.querySelector('input');
    newInput.focus();
}

function removeMember(button) {
    const memberItem = button.closest('.anggota-item');
    memberItem.style.animation = 'fade-out 0.3s ease-out';

    setTimeout(() => {
        memberItem.remove();
        memberCount--;
        updateRemoveButtons();
        updateMemberNumbers();
    }, 300);
}

function updateRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-member');
    const memberItems = document.querySelectorAll('.anggota-item');

    if (memberItems.length <= 1) {
        removeButtons.forEach(btn => btn.classList.add('hidden'));
    } else {
        removeButtons.forEach(btn => btn.classList.remove('hidden'));
    }
}

function updateMemberNumbers() {
    const memberNumbers = document.querySelectorAll('.member-number');
    memberNumbers.forEach((number, index) => {
        number.textContent = index + 1;
    });
}

// Add some CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-out {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }
`;
document.head.appendChild(style);

// Initialize
updateRemoveButtons();
</script>

@endsection