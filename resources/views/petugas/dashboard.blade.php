@extends('layouts.app')

@section('content')
<div class="text-center py-20">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Dashboard Petugas</h1>
    <p class="text-gray-600 mb-6">Selamat datang, Petugas piket hari ini.</p>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Logout
        </button>
    </form>
</div>
@endsection
