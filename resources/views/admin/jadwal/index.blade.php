@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Jadwal Rolling (Kalender)</h1>
        <a href="{{ route('admin.jadwal.generate') }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">+ Generate Jadwal Rolling</a>
    </div>

    <div id="calendar" class="bg-white rounded-lg shadow p-4"></div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                events: @json($events)
            });

            calendar.render();
        });
    </script>
@endpush
