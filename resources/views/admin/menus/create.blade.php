@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-slate-800 mb-6">Tambah Menu</h2>

        <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label for="tanggal" class="block text-sm font-medium text-slate-700">Tanggal</label>
                <input type="date"
                       name="tanggal"
                       id="tanggal"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       required>
            </div>

            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-slate-700">Nama Menu</label>
                <input type="text"
                       name="name"
                       id="name"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       placeholder="Masukkan nama menu"
                       required>
            </div>

            <div class="space-y-2">
                <label for="sesi" class="block text-sm font-medium text-slate-700">Sesi Menu</label>
                <select name="sesi"
                        id="sesi"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white"
                        required>
                    <option value="">-- Pilih Sesi --</option>
                    <option value="pagi">Pagi</option>
                    <option value="siang">Siang</option>
                    <option value="malam">Malam</option>
                </select>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-green-600 text-white py-2.5 px-4 rounded-md font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection