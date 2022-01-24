<?php

namespace App\Services\Tenongan;

use App\Models\Tenongan\Penjualan;
use App\Models\Tenongan\TempFile;
use App\Services\SpreadsheetService;

class TempService
{
    protected $data = [];
    protected $files = [];
    public function __construct(SpreadsheetService $spreadsheetService)
    {
        $this->spreadsheetService = $spreadsheetService;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function createTemp()
    {
        foreach ($this->data as $key => $value) {
            TempFile::updateOrCreate(['filename' => $value['filename']], ['data' => $value['data'], 'path' => $value['path']]);
            debugbar()->info($value);
        }
        return 'berhasil';
    }

    public function setFiles($files)
    {
        $this->files = $files;
        foreach ($files as $key => $file) {
            $content = $this->spreadsheetService->setSpreadsheet($file['path'])->getData();
            foreach ($content['data'] as $key => $value) {
                $content['data'][$key]['laku'] = isset($content['data'][$key]['sisa']) ? $content['data'][$key]['titip'] - $content['data'][$key]['sisa'] : $content['data'][$key]['titip'];
                $content['data'][$key]['pedagang_id'] = $content['pedagang_id'];
                unset($content['data'][$key]['sisa']);
            }
            $data = [
                'filename' => $file['name'],
                'data' => json_encode($content['data']),
                'path' => $file['path'],
            ];
            array_push($this->data, $data);
            debugbar()->info($file);
        }
        return $this;
    }

    public function getTempFile()
    {
        $penjualan = TempFile::all();
        $penjualan->each(function ($penjualan) {
            $penjualan['data'] = json_decode($penjualan['data'], true);
        });
        return $penjualan;
    }

    public function conclude()
    {
        $temps = $this->getTempFile();
        $temps->each(function($temp){
            $temp->conclude();
        });
        debugbar()->info(TempFile::truncate());
        debugbar()->info('testConclude');
    }
}
