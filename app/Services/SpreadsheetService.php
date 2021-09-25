<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Storage;

class SpreadsheetService
{
    public function makeSpreedsheet()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $sheet->setCellValue('A2', 'Hello W22orld !');
        $sheet->setCellValue('A5', 'Hello W55orld !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');

        ob_start();
        $writer->save('php://output');
        $content = ob_get_contents();
        ob_end_clean();

        Storage::disk('local')->put("public/myfile.xlsx", $content);
    }

    public function readSpreedsheet()
    {
        $inputFileName = 'storage/penjualan.xls';
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $head = [];
        $prev = null;
        $values = [];
        $cellCollection = $worksheet->getCellCollection();
        $cords = $cellCollection->getCoordinates();
        foreach ($cords as $cord) {
            $value = $cellCollection->get($cord)->getValue();
            $outputString = preg_replace('/[^0-9]/', '', $cord);
            if ($prev) {
                if ($prev != $outputString) {
                    break;
                } else {
                    array_push($head, $value);
                }
            } else {
                $prev = $outputString;
                array_push($head, $value);
            }
        }
        $cursor_limit = count($head);
        $cursor = 0;
        $row = [];
        foreach ($cords as $cord) {
            $value = $cellCollection->get($cord)->getValue();
            $row[$head[$cursor]] = $value;
            if ($cursor == $cursor_limit-1) {
                array_push($values, $row);
                $cursor = 0;
                $row = [];
            } else {

                $cursor++;
            }
        }
        array_shift($values);
        dd($values);
        // dd($worksheet->getCellCollection());
        // if ('' > 'B2') {
        //     dd('besar a');
        // } else {
        //     dd('besar b');
        // }

    }
}
