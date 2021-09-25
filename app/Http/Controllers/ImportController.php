<?php

namespace App\Http\Controllers;

use App\Imports\PedagangImport;
use App\Imports\ProdusenImport;
use Illuminate\Http\Request;
use Excel;

class ImportController extends Controller
{
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
        // return response()->json($request->file('file'));


        // $path = $request->file('file')->store('file');
        try {
            $test = Excel::import(new PedagangImport,$request->file('file'));
            return response()->json($test);
        } catch (\Throwable $th) {
        return response($th);
        }
    }
}
