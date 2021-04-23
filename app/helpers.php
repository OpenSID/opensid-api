<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

define("LOKASI_LOGO_DESA", 'desa/logo/');
define("LOKASI_USER_PICT", 'desa/upload/user_pict/');

if (! function_exists('url_foto')) {
    /**
     * Helper untuk mengambil url foto.
     * 
     * @param string $foto
     * @param string $ukuran
     * @param int $sex
     */
    function url_foto(string $foto, string $ukuran = 'kecil_', int $sex = 1)
    {
        if (Str::contains($foto, ['kuser.png', 'wuser.png'])) {
            return config('opensid.host') . LOKASI_USER_PICT . $foto;
        }

        if (empty($foto)) {
            return $sex == 2
                ? config('opensid.host') . 'assets/files/user_pict/wuser.png'
                : config('opensid.host') . 'assets/files/user_pict/kuser.png';
        }

        $ukuran = ($ukuran == 'kecil_') ? 'kecil_' : '';
        $file_foto = config('opensid.host') . LOKASI_USER_PICT . $ukuran . $foto;

        if (! Storage::disk('ftp')->exists(LOKASI_USER_PICT . $ukuran . $foto)) {
            $file_foto = $sex == 2
                ? config('opensid.host') . 'assets/files/user_pict/wuser.png'
                : config('opensid.host') . 'assets/files/user_pict/kuser.png';
        }

        return $file_foto;
    }
}