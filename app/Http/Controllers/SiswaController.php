<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Tugas;
use App\Models\Materi;
use App\Models\AbsensiSiswa;
use App\Models\KalenderSekolah; // Import model KalenderSekolah
use Carbon\Carbon; // Import Carbon

class SiswaController extends Controller
{
    /**
     * Menampilkan dashboard siswa dengan data statistik.
     */
    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();
        $siswa->load('kelas.jurusan', 'kelas.waliKelas');

        $jumlahTugas = 0;
        $jumlahMateri = 0;
        $tugasTerbaru = collect();

        if ($siswa->kelas) {
            $jumlahTugas = Tugas::where('kelas_id', $siswa->kelas_id)->count();
            $jumlahMateri = Materi::where('kelas_id', $siswa->kelas_id)->count();
            $tugasTerbaru = Tugas::where('kelas_id', $siswa->kelas_id)
                                ->with('mapel', 'guru')
                                ->latest()
                                ->take(5)
                                ->get();
        }

        $jumlahKehadiran = AbsensiSiswa::where('siswa_id', $siswa->id)
                                    ->where('status', 'Hadir')
                                    ->count();

        return view('siswa.dashboard', compact(
            'siswa',
            'jumlahTugas',
            'jumlahMateri',
            'jumlahKehadiran',
            'tugasTerbaru'
        ));
    }

    /**
     * Menampilkan halaman profil siswa.
     */
    public function showProfil()
    {
        $siswa = Auth::guard('siswa')->user()->load('user', 'kelas.jurusan', 'kelas.waliKelas');
        return view('siswa.profil.show', compact('siswa'));
    }

    /**
     * Menampilkan form untuk mengubah password.
     */
    public function showChangePasswordForm()
    {
        return view('siswa.profil.change-password');
    }

    /**
     * Memperbarui password siswa.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::guard('siswa')->user()->password)) {
                    $fail('Password lama tidak sesuai.');
                }
            }],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
        ]);

        $siswa = Auth::guard('siswa')->user();
        $siswa->password = Hash::make($request->password);
        $siswa->save();

        return redirect()->route('siswa.profil.show')->with('status', 'Password berhasil diperbarui!');
    }

    /**
     * Menampilkan kalender akademik untuk siswa.
     */
    public function showKalender()
    {
        $events = KalenderSekolah::all();

        $formattedEvents = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start_date,
                // Tambah 1 hari agar tanggal selesai ikut ter-highlight di kalender
                'end' => Carbon::parse($event->end_date)->addDay()->toDateString(),
                'allDay' => true,
                'backgroundColor' => $event->color,
                'borderColor' => $event->color,
                // Menyertakan deskripsi untuk ditampilkan di modal
                'extendedProps' => [
                    'description' => $event->description ?? 'Tidak ada deskripsi untuk kegiatan ini.'
                ]
            ];
        });

        return view('siswa.kalender.index', [
            'events' => $formattedEvents->toJson()
        ]);
    }
}
