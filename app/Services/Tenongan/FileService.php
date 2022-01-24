<?php

namespace App\Services\Tenongan;

use Storage;

class FileService
{
    public $tempPath = 'temp';
    public $files = [];
    public function __construct()
    {
    }

    public function handleUploadedFiles(array $files)
    {
        $path = "temp/" . now()->toDateString();
        Storage::makeDirectory($path);
        foreach ($files as $key => $file) {
            $data = Storage::putFileAs($path, $file, $file->getClientOriginalName());
            $filePath = storage_path("app/" . $path);
            array_push($this->files, ['name' => $file->getClientOriginalName(), 'path' => $filePath, 'content' => Storage::get($path . "/" . $file->getClientOriginalName())]);
        }
        return $this;
    }

    public function getFiles()
    {
        return $this->files;
    }
}
