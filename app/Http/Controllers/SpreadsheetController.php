<?php

namespace App\Http\Controllers;

use App\Services\SpreadsheetService;
use Illuminate\Http\Request;

class SpreadsheetController extends Controller
{
    //
    private $spreedsheetService;
    public function __construct() {
        $this->spreedsheetService = new SpreadsheetService ;
    }
    public function make()
    {
        try {
            $this->spreedsheetService->makeSpreedsheet();
            return 'berhasi';
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function read()
    {
        try {
            $this->spreedsheetService->readSpreedsheet('penjualan.xls');
            $data = $this->spreedsheetService->getData('penjualans');
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
