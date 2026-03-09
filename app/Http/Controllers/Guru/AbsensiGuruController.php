<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AbsensiGuruController extends Controller
{
    public function create()
    {
        return view('guru.absensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_absen' => 'required|in:masuk,pulang',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $guru = Auth::guard('guru')->user();
        $today = Carbon::today();

        if ($request->jenis_absen == 'masuk') {
            // Cek apakah sudah absen masuk hari ini
            $absensiHariIni = AbsensiGuru::where('guru_id', $guru->id)
                ->whereDate('waktu_masuk', $today)
                ->first();

            if ($absensiHariIni) {
                return redirect()->back()->with('error', 'Anda sudah melakukan absensi masuk hari ini.');
            }

            AbsensiGuru::create([
                'guru_id' => $guru->id,
                'waktu_masuk' => now(),
                'latitude_masuk' => $request->latitude,
                'longitude_masuk' => $request->longitude,
                'status' => 'Hadir' // Menambahkan status default
            ]);

            return redirect()->route('guru.dashboard')->with('success', 'Berhasil melakukan absensi masuk.');
        } else { // Absen Pulang
            $absensiHariIni = AbsensiGuru::where('guru_id', $guru->id)
                ->whereDate('waktu_masuk', $today)
                ->whereNull('waktu_keluar')
                ->first();

            if (!$absensiHariIni) {
                return redirect()->back()->with('error', 'Anda belum melakukan absensi masuk hari ini atau sudah absen pulang.');
            }

            $absensiHariIni->update([
                'waktu_keluar' => now(),
                'latitude_keluar' => $request->latitude,
                'longitude_keluar' => $request->longitude,
            ]);

            return redirect()->route('guru.dashboard')->with('success', 'Berhasil melakukan absensi pulang.');
        }
    }

    public function riwayat(Request $request)
    {
        $guru = Auth::guard('guru')->user();
        $periode = $request->input('periode', Carbon::now()->format('Y-m'));
        $tanggalPilihan = Carbon::createFromFormat('Y-m', $periode);

        $mulaiBulan = $tanggalPilihan->copy()->startOfMonth();
        $akhirBulan = $tanggalPilihan->copy()->endOfMonth();

        $absensiDalamBulan = AbsensiGuru::where('guru_id', $guru->id)
            ->whereBetween('waktu_masuk', [$mulaiBulan, $akhirBulan])
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->waktu_masuk)->format('Y-m-d');
            });

        $rentangTanggal = CarbonPeriod::create($mulaiBulan, $akhirBulan);
        $riwayatLengkap = [];

        foreach ($rentangTanggal as $tanggal) {
            $formatTanggal = $tanggal->format('Y-m-d');

            $absensiHariIni = $absensiDalamBulan->get($formatTanggal);

            if ($absensiHariIni) {
                $absensiHariIni->tanggal = new Carbon($absensiHariIni->waktu_masuk);
                $riwayatLengkap[] = $absensiHariIni;
            } else {
                $status = $tanggal->isWeekend() ? 'Weekend' : 'Tidak Hadir';
                $riwayatLengkap[] = (object)[
                    'tanggal' => $tanggal,
                    'status' => $status,
                    'waktu_masuk' => null,
                    'waktu_keluar' => null,
                ];
            }
        }

        $riwayatAbsensi = collect($riwayatLengkap)->sortBy('tanggal');

        return view('guru.absensi.riwayat', compact('riwayatAbsensi', 'periode'));
    }
}
