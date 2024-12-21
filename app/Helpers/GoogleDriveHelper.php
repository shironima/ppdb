<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class GoogleDriveHelper
{
    public static function createFolder($folderName, $parentFolder = null)
    {
        $disk = Storage::disk('google');
        $folders = collect($disk->directories($parentFolder));

        // Periksa apakah folder sudah ada
        if ($folders->contains($parentFolder . '/' . $folderName)) {
            return $parentFolder ? $parentFolder . '/' . $folderName : $folderName;
        }

        // Buat folder baru
        $disk->makeDirectory($parentFolder ? $parentFolder . '/' . $folderName : $folderName);

        return $parentFolder ? $parentFolder . '/' . $folderName : $folderName;
    }
}
