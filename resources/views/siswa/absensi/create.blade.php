@extends('layouts.siswa')

@section('content')
<div class="container">
    <h2 class="mb-4">Form Absensi Siswa</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div id="current-time" class="fw-bold fs-4"></div>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.absensi.store') }}" method="POST" id="absensiForm">
                @csrf
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <div class="mb-3">
                    <label for="jenis_absen" class="form-label">Tipe Absen</label>
                    <select name="jenis_absen" id="jenis_absen" class="form-select">
                        <option value="masuk">Masuk</option>
                        <option value="pulang">Pulang</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi Anda Saat Ini</label>
                    <div id="map-container" style="height: 300px; width: 100%; border-radius: 8px; background-color: #e9ecef;">
                         <img id="map-preview" src="" style="width: 100%; height: 100%; border-radius: 8px; object-fit: cover;">
                    </div>
                    <div class="form-text">Pastikan Anda mengizinkan akses lokasi pada browser.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Kirim Absensi</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Fungsi untuk menampilkan jam dan tanggal real-time
    function updateTime() {
        const now = new Date();
        const formattedDate = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        const formattedTime = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('current-time').textContent = `${formattedDate}, ${formattedTime}`;
    }
    
    // Fungsi untuk mendapatkan lokasi dan menampilkan peta
    function setupLocationAndMap() {
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const mapPreview = document.getElementById('map-preview');
        const mapContainer = document.getElementById('map-container');
        const apiKey = '{{ config('googlemaps.api_key') }}';

        if (!apiKey) {
            mapContainer.innerHTML = '<div class="d-flex justify-content-center align-items-center h-100 text-danger">GOOGLE_MAPS_API_KEY belum diatur.</div>';
            return;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const { latitude, longitude } = position.coords;
                latitudeInput.value = latitude;
                longitudeInput.value = longitude;

                const mapUrl = `https://maps.googleapis.com/maps/api/staticmap?center=${latitude},${longitude}&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7Clabel:S%7C${latitude},${longitude}&key=${apiKey}`;
                
                mapPreview.src = mapUrl;
                mapPreview.style.display = 'block';
                mapContainer.style.backgroundColor = 'transparent';

            }, error => {
                console.error(error);
                mapContainer.innerHTML = '<div class="d-flex justify-content-center align-items-center h-100 text-danger">Gagal mendapatkan lokasi. Izinkan akses lokasi dan pastikan Anda memiliki koneksi internet yang stabil.</div>';
            });
        } else {
             mapContainer.innerHTML = '<div class="d-flex justify-content-center align-items-center h-100 text-warning">Geolocation tidak didukung oleh browser ini.</div>';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Update waktu setiap detik
        updateTime();
        setInterval(updateTime, 1000);

        // Siapkan lokasi dan peta
        setupLocationAndMap();
    });
</script>
@endpush
