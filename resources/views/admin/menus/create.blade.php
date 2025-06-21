@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6 text-gray-800">Tambah Menu</h2>

    <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
            <input type="date"
                   name="tanggal"
                   id="tanggal"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none"
                   required>
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none"
                   placeholder="Masukkan nama menu"
                   required>
        </div>

        <div>
            <label for="sesi" class="block text-sm font-medium text-gray-700 mb-2">Sesi Menu</label>
            <select name="sesi"
                    id="sesi"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white"
                    required>
                <option value="">-- Pilih Sesi --</option>
                <option value="pagi">Pagi</option>
                <option value="siang">Siang</option>
                <option value="malam">Malam</option>
            </select>
        </div>

        <div class="pt-2">
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 font-medium">
                Simpan Menu
            </button>
        </div>
    </form>
</div>
@endsection