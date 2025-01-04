<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Simpan file ke disk 'public' di dalam folder yang ditentukan.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder
     * @param  string  $fileName
     * @return string
     */
    public static function storeFile($file, $folder, $fileName)
    {
        return $file->storeAs($folder, $fileName, 'public');
    }

    /**
     * Mendapatkan URL file yang disimpan di disk 'public'.
     *
     * @param  string  $filePath
     * @return string
     */
    public static function getFileUrl($filePath)
    {
        return Storage::url($filePath);
    }
}
