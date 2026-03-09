<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KalenderSekolah;

class DashboardController extends Controller
{
    /**
     * Menampilkan kalender akademik untuk guru.
     *
     * @return \Illuminate\View\View
     */
    public function showKalender()
    {
        $events = KalenderSekolah::all();

        $formattedEvents = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'allDay' => true,
                'backgroundColor' => $event->color,
                'borderColor' => $event->color
            ];
        });

        return view('guru.kalender.index', [
            'events' => $formattedEvents->toJson()
        ]);
    }
}
