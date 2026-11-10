<?php

return [
    // Interval refresh dashboard dalam detik (minimal 10 detik).
    'refresh_seconds' => env('ISPU_DISPLAY_REFRESH', 30),

    // Isi nama lokasi sesuai device_id. Contoh: 37 => 'Muara Bulian'.
    // Bila belum diisi, dashboard menampilkan "AQMS Device #<device_id>".
    'locations' => [
        // 37 => 'Nama Lokasi AQMS',
    ],
];
