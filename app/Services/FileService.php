<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class FileService
{
    public function upload($file, $path, $timestamp = false)
    {
        $fileName = $timestamp ? time() . $file->getClientOriginalName() : $file->getClientOriginalName();
        $file->move($path, $fileName);
        return $fileName;
    }

    public function delete($pathFile)
    {
        File::delete($pathFile);
    }
}