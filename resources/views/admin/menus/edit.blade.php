@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Edit Menu</h2>

            <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $menu->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                </div>

                <div class="space-y-2">
                    <label for="sesi" class="block text-sm font-medium text-gray-700">Sesi</label>
                    <select name="sesi"
                            id="sesi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="pagi" {{ old('sesi', $menu->sesi) == 'pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="siang" {{ old('sesi', $menu->sesi) == 'siang' ? 'selected' : '' }}>Siang</option>
                        <option value="malam" {{ old('sesi', $menu->sesi) == 'malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           id="tanggal"
                           value="{{ old('tanggal', $menu->tanggal) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2.5 px-4 rounded-md font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Update Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection