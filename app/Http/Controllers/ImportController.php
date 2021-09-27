<?php

namespace App\Http\Controllers;

use App\Contracts\Tenongan\TenonganService;
use App\Imports\PedagangImport;
use App\Imports\ProdukImport;
use App\Imports\ProdusenImport;
use App\Models\Tenongan\Pedagang;
use App\Models\tenongan\Penjualan;
use App\Services\SpreadsheetService;
use Illuminate\Http\Request;
use Excel;

class ImportController extends Controller
{
    protected $spreadsheetService;
    protected $tenonganService;
    public function __construct(TenonganService $tenonganService) {
        $this->tenonganService = $tenonganService;
        $this->spreadsheetService = new SpreadsheetService();
    }

    //
    public function produsen(Request $request)
    {
        // return response()->json($request->file('file'));


        // $path = $request->file('file')->store('file');
        try {
            Excel::import(new ProdusenImport,$request->file('file'));
            return response('berhasil2');
        } catch (\Throwable $th) {
        return response($th);
        }

    }
    public function pedagang(Request $request)
    {
        try {
            $test = Excel::import(new PedagangImport,$request->file('file'));
            return response()->json($test);
        } catch (\Throwable $th) {
        return response($th);
        }
    }
    public function produk(Request $request)
    {
        try {
            $data = Excel::import(new ProdukImport, $request->file('file'));
            return response()->json($data);
        } catch (\Throwable $th) {
        return response($th);
        }
    }

    public function penjualan(Request $request)
    {
        $file = $request->file('file')->storeAs('public','penjualan.xlsx');
        $data = $this->spreadsheetService->setSpreadsheet('penjualan.xlsx')->getData();
        foreach ($data['data'] as $key => $value) {
            $data['data'][$key]['laku'] = isset($data['data'][$key]['sisa']) ? $data['data'][$key]['titip'] - $data['data'][$key]['sisa'] : $data['data'][$key]['titip'];
            $data['data'][$key]['pedagang_id'] = $data['pedagang_id'];
            unset($data['data'][$key]['sisa']);
        }
        $this->tenonganService->createPenjualans($data['data']);

        return response()->json($data['data']);
        $penjualans = Pedagang::find($data['produsen_id'])->penjualan()->insert($data['data']);
        $penjualans = $this->tenongan->createPenjualans(json_decode($request->getContent(),true));
    }
}
