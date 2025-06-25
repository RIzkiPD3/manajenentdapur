@extends('layouts.admin')

@section('page-title', 'Tambah Kelompok')
@section('page-description', 'Buat kelompok piket baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-slate-800">Tambah Kelompok Piket</h2>
            <p class="text-sm text-slate-600 mt-1">Masukkan informasi kelompok piket baru</p>
        </div>

        <form action="{{ route('admin.kelompok.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Nama Kelompok -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Kelompok
                </label>
                <input type="text"
                       name="nama_kelompok"
                       value="{{ old('nama_kelompok') }}"
                       required
                       placeholder="Masukkan nama kelompok..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('nama_kelompok') border-red-500 @enderror">
                @error('nama_kelompok')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Urutan
                </label>
                <input type="number"
                       name="urutan"
                       value="{{ old('urutan') }}"
                       required
                       min="1"
                       placeholder="Masukkan urutan kelompok..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('urutan') border-red-500 @enderror">
                @error('urutan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Anggota -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Anggota Kelompok
                </label>

                <div id="anggota-container" class="space-y-3">
                    <!-- First member input -->
                    <div class="anggota-item flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center">
                            <span class="text-sm font-medium text-slate-600 member-number">1</span>
                        </div>
                        <input type="text"
                               name="anggota[]"
                               value="{{ old('anggota.0') }}"
                               placeholder="Nama anggota..."
                               required
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <button type="button"
                                class="remove-member hidden flex-shrink-0 w-8 h-8 text-red-500 hover:bg-red-50 rounded-full flex items-center justify-center"
                                onclick="removeMember(this)">
                            <i class="fa-solid fa-times text-sm"></i>
                        </button>
                    </div>

                    @if(old('anggota'))
                        @foreach(old('anggota') as $index => $anggota)
                            @if($index > 0)
                                <div class="anggota-item flex items-center gap-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-slate-600 member-number">{{ $index + 1 }}</span>
                                    </div>
                                    <input type="text"
                                           name="anggota[]"
                                           value="{{ $anggota }}"
                                           placeholder="Nama anggota..."
                                           required
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    <button type="button"
                                            class="remove-member flex-shrink-0 w-8 h-8 text-red-500 hover:bg-red-50 rounded-full flex items-center justify-center"
                                            onclick="removeMember(this)">
                                        <i class="fa-solid fa-times text-sm"></i>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                @error('anggota')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Add Member Button -->
                <button type="button"
                        onclick="addMember()"
                        class="mt-3 w-full py-2 border-2 border-dashed border-gray-300 text-slate-600 rounded-lg hover:border-orange-500 hover:text-orange-500 transition-colors font-medium">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Tambah Anggota
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.kelompok.index') }}"
                   class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors">
                    <i class="fa-solid fa-save mr-2"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let memberCount = document.querySelectorAll('.anggota-item').length;

function addMember() {
    memberCount++;
    const container = document.getElementById('anggota-container');

    const memberItem = document.createElement('div');
    memberItem.className = 'anggota-item flex items-center gap-3';

    memberItem.innerHTML = `
        <div class="flex-shrink-0 w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center">
            <span class="text-sm font-medium text-slate-600 member-number">${memberCount}</span>
        </div>
        <input type="text"
               name="anggota[]"
               placeholder="Nama anggota..."
               required
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
        <button type="button"
                class="remove-member flex-shrink-0 w-8 h-8 text-red-500 hover:bg-red-50 rounded-full flex items-center justify-center"
                onclick="removeMember(this)">
            <i class="fa-solid fa-times text-sm"></i>
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
    memberItem.remove();
    memberCount--;
    updateRemoveButtons();
    updateMemberNumbers();
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

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateRemoveButtons();
});
</script>

@endsection