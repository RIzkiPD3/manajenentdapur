@extends('layouts.petugas')

@section('content')
<div class="text-center mt-10">
    <h1 class="text-3xl font-bold">Dashboard Petugas</h1>
    <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}!</p>
</div>
@endsection
