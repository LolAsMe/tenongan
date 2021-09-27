<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Storage;
use Str;

class SpreadsheetService
{
    protected $spreadsheet;
    protected $filename;
    protected $path;
    protected $storagePath;

    public function __construct(
        $filename = '',
        $path='storage/',
        $storagePath = 'public/',
        $defaultExtension = 'Xlsx'
        )
        {
        $this->spreadsheet = new Spreadsheet();
        $this->filename = $filename;
        $this->path = $path;
        $this->storagePath = $storagePath;
        $this->defaultExtension = $defaultExtension;
    }

    public function getSpreadsheet()
    {
        return $this->spreadsheet;
    }

    // public function setSpreadsheet(Spreadsheet $spreadsheet)
    // {
    //     $this->spreadsheet = $spreadsheet;
    //     return $this;
    // }

    public function makeSpreedsheet()
    {
        $this->spreadsheet = new Spreadsheet();
        // $sheet = $this->spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');
        // $sheet->setCellValue('A2', 'Hello W22orld !');
        // $sheet->setCellValue('A5', 'Hello W55orld !');

        // $writer = new Xlsx($this->spreadsheet);
        // $file = $this->readFile($this->spreadsheet);
        // $this->store('fi2lebaru.xlsx',$file);
        return $this->spreadsheet;
        // $writer->save('hello world.xlsx');
    }

    public function makeFile($filename, Spreadsheet $spreadsheet)
    {
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return $spreadsheet;
    }
    public function readSpreedsheet($file)
    {
        ob_start();
        $file->save('php://output');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function store($name, $file)
    {

        Storage::disk('local')->put("public/".$name, $file);
    }

    public function setSpreadsheet($name)
    {
        $inputFileName = 'storage/'.$name;
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $this->spreadsheet = $spreadsheet;

        return $this;
    }

    public function toArray(?Spreadsheet $spreadsheet=null)
    {
        $worksheet = $spreadsheet ? $spreadsheet->getActiveSheet() : $this->spreadsheet->getActiveSheet();
        $head = [];
        $prev = null;
        $values = [];
        $cellCollection = $worksheet->getCellCollection();
        $cords = $cellCollection->getCoordinates();
        $highestRow = $cellCollection->getHighestRow();
        $firstCell = '';
        foreach ($cords as $cord) {
            $value = $cellCollection->get($cord)->getValue();
            $outputString = preg_replace('/[^0-9]/', '', $cord);
            $outputCol = preg_replace('/[^A-Z]/', '', $cord);
            if ($prev) {
                if ($prev != $outputString) {
                    $firstCell = $outputString;
                    break;
                } else {
                    $head[$outputCol] = $value;
                }
            } else {
                $prev = $outputString;
                $head[$outputCol] = $value;
            }
        }

        $outputString = preg_replace('/[^0-9]/', '', $cord);
        for ($i=$firstCell; $i <= $highestRow; $i++) {
            $obj= [];
            foreach ($head as $key => $value) {
                $obj[$value] = $cellCollection->get($key.$i) ? $cellCollection->get($key.$i)->getValue(): null;
            }
            array_push($values, $obj);
        }
        return $values;

    }
    public function getData($title='data')
    {
        $worksheetName=$this->spreadsheet->getActiveSheet()->getTitle();
        $id = preg_replace('/[^0-9]/', '', $worksheetName);
        // $outputCol = preg_replace('/[^A-Z]/', '', $worksheetName);
        $words = preg_replace('/\d+/u', '', $worksheetName);
        $field = Str::lower($words);
        $data = [$field=>$id, $title=>$this->toArray()];
        return $data;
    }
}
