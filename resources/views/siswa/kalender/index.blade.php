@extends('layouts.siswa')

@section('title', 'Kalender Akademik')

@push('styles')
{{-- Memuat CSS FullCalendar dari CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Kalender Akademik</h6>
                    <p class="text-sm mb-0">Lihat jadwal kegiatan dan hari libur sekolah.</p>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Memuat JavaScript FullCalendar dari CDN --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            // Menggunakan data events dari controller
            events: {!! $events !!} 
        });
        calendar.render();
    });
</script>
@endpush
