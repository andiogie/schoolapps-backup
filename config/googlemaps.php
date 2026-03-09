<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Maps API Key
    |--------------------------------------------------------------------------
    |
    | Kunci API ini digunakan untuk otentikasi dengan layanan Google Maps
    | yang digunakan untuk menampilkan peta statis pada fitur absensi.
    | Dapatkan kunci Anda dari Google Cloud Console.
    |
    */

    'api_key' => env('GOOGLE_MAPS_API_KEY', ''),
];
