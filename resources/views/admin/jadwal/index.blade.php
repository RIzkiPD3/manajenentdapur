@extends('layouts.admin')

@section('page-title', 'Jadwal Rolling')
@section('page-description', 'Kelola dan lihat jadwal rolling dalam tampilan kalender')

@section('content')
    <!-- Header Section -->
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-calendar-days text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">Jadwal Rolling</h1>
                        <p class="text-slate-600">Tampilan kalender untuk jadwal rolling dapur</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- Calendar View Toggle -->
                    <div class="bg-slate-100 rounded-lg p-1 hidden sm:flex">
                        <button id="month-view-btn" class="px-3 py-2 text-sm font-medium text-slate-600 rounded-md transition-colors hover:text-slate-800">
                            <i class="fa-solid fa-calendar mr-2"></i>Bulan
                        </button>
                        <button id="list-view-btn" class="px-3 py-2 text-sm font-medium text-slate-600 rounded-md transition-colors hover:text-slate-800">
                            <i class="fa-solid fa-list mr-2"></i>List
                        </button>
                    </div>

                    <!-- Generate Button -->
                    <a href="{{ route('admin.jadwal.generate') }}"
                       class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium rounded-lg shadow-sm transition-all duration-200 hover:shadow-md transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Generate Jadwal
                    </a>
                </div>
            </div>
        </div>

        <!-- Calendar Container -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Calendar Header Info -->
            <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 text-sm text-slate-600">
                            <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                            <span>Jadwal Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-slate-600">
                            <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                            <span>Jadwal Mendatang</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-slate-600">
                            <div class="w-3 h-3 bg-slate-400 rounded-full"></div>
                            <span>Jadwal Selesai</span>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="hidden md:flex items-center space-x-6 text-sm">
                        <div class="text-center">
                            <div class="font-semibold text-slate-800" id="total-events">-</div>
                            <div class="text-slate-500">Total Jadwal</div>
                        </div>
                        <div class="text-center">
                            <div class="font-semibold text-purple-600" id="active-events">-</div>
                            <div class="text-slate-500">Aktif Hari Ini</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar Body -->
            <div class="p-6">
                <div id="calendar" class="calendar-container"></div>
            </div>
        </div>


    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <style>
        /* Custom FullCalendar Styling */
        .fc {
            font-family: inherit;
        }

        .fc-toolbar-title {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #1e293b !important;
        }

        .fc-button-primary {
            background-color: #6366f1 !important;
            border-color: #6366f1 !important;
            color: white !important;
            font-weight: 500 !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 1rem !important;
            transition: all 0.2s ease !important;
        }

        .fc-button-primary:hover {
            background-color: #4f46e5 !important;
            border-color: #4f46e5 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }

        .fc-button-primary:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3) !important;
        }

        .fc-daygrid-day {
            border-color: #e2e8f0 !important;
        }

        .fc-daygrid-day-top {
            padding: 0.5rem !important;
        }

        .fc-day-today {
            background-color: #fef3e2 !important;
        }

        .fc-event {
            border: none !important;
            border-radius: 0.375rem !important;
            padding: 0.25rem 0.5rem !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            margin: 1px !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
        }

        .fc-event:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }

        .fc-event-title {
            overflow: hidden !important;
            white-space: nowrap !important;
            text-overflow: ellipsis !important;
        }

        .fc-col-header-cell {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
            font-weight: 600 !important;
            color: #475569 !important;
            padding: 0.75rem 0 !important;
        }

        .fc-scrollgrid {
            border-color: #e2e8f0 !important;
            border-radius: 0.5rem !important;
            overflow: hidden !important;
        }

        .fc-daygrid-day-number {
            color: #64748b !important;
            font-weight: 500 !important;
            padding: 0.25rem !important;
        }

        .fc-day-today .fc-daygrid-day-number {
            color: #ea580c !important;
            font-weight: 700 !important;
        }

        /* Loading state */
        .calendar-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 400px;
            color: #64748b;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .fc-toolbar {
                flex-direction: column !important;
                gap: 1rem !important;
            }

            .fc-toolbar-chunk {
                display: flex !important;
                justify-content: center !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            let calendar;

            // Show loading state
            calendarEl.innerHTML = '<div class="calendar-loading"><i class="fa-solid fa-spinner fa-spin mr-2"></i>Memuat kalender...</div>';

            // Initialize calendar
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                locale: 'id',
                firstDay: 1, // Start week on Monday
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    list: 'List'
                },
                events: @json($events),
                eventDisplay: 'block',
                dayMaxEvents: 3,
                moreLinkText: function(num) {
                    return '+' + num + ' lainnya';
                },
                eventClick: function(info) {
                    // Handle event click
                    showEventDetails(info.event);
                },
                eventDidMount: function(info) {
                    // Add custom styling based on event properties
                    const event = info.event;
                    const el = info.el;

                    // Add tooltip
                    el.setAttribute('title', event.title + '\n' +
                        (event.extendedProps.description || ''));

                    // Custom colors based on event type or status
                    if (event.extendedProps.status === 'active') {
                        el.style.backgroundColor = '#8b5cf6';
                        el.style.borderColor = '#7c3aed';
                    } else if (event.extendedProps.status === 'upcoming') {
                        el.style.backgroundColor = '#f59e0b';
                        el.style.borderColor = '#d97706';
                    } else if (event.extendedProps.status === 'completed') {
                        el.style.backgroundColor = '#6b7280';
                        el.style.borderColor = '#4b5563';
                    }
                },
                datesSet: function() {
                    updateStats();
                }
            });

            calendar.render();

            // View toggle buttons
            const monthViewBtn = document.getElementById('month-view-btn');
            const listViewBtn = document.getElementById('list-view-btn');

            if (monthViewBtn && listViewBtn) {
                monthViewBtn.addEventListener('click', function() {
                    calendar.changeView('dayGridMonth');
                    updateViewButtons('month');
                });

                listViewBtn.addEventListener('click', function() {
                    calendar.changeView('listWeek');
                    updateViewButtons('list');
                });
            }

            function updateViewButtons(activeView) {
                const monthBtn = document.getElementById('month-view-btn');
                const listBtn = document.getElementById('list-view-btn');

                // Reset classes
                monthBtn.className = 'px-3 py-2 text-sm font-medium text-slate-600 rounded-md transition-colors hover:text-slate-800';
                listBtn.className = 'px-3 py-2 text-sm font-medium text-slate-600 rounded-md transition-colors hover:text-slate-800';

                // Add active class
                if (activeView === 'month') {
                    monthBtn.className = 'px-3 py-2 text-sm font-medium bg-white text-purple-600 rounded-md shadow-sm';
                } else {
                    listBtn.className = 'px-3 py-2 text-sm font-medium bg-white text-purple-600 rounded-md shadow-sm';
                }
            }

            function updateStats() {
                const events = calendar.getEvents();
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                const totalEvents = events.length;
                const activeToday = events.filter(event => {
                    const eventDate = new Date(event.start);
                    eventDate.setHours(0, 0, 0, 0);
                    return eventDate.getTime() === today.getTime();
                }).length;

                document.getElementById('total-events').textContent = totalEvents;
                document.getElementById('active-events').textContent = activeToday;
            }

            function showEventDetails(event) {
                // Create a simple modal or alert with event details
                const details = `
                    Judul: ${event.title}
                    Tanggal: ${event.start.toLocaleDateString('id-ID')}
                    ${event.extendedProps.description ? 'Deskripsi: ' + event.extendedProps.description : ''}
                `;

                alert(details);
                // You can replace this with a proper modal implementation
            }

            // Initialize view buttons
            updateViewButtons('month');

            // Initial stats update
            setTimeout(updateStats, 100);
        });
    </script>
@endpush