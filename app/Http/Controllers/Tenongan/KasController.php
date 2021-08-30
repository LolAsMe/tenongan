<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;

use App\Models\Tenongan\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kas = Kas::all();
        return response()->json($kas);
    }

    public function show(Kas $kas)
    {
        //
        return response()->json($kas->load('logKas'));

    }

    /**
     * Menambahkan jumlah kas(detail sudah termaasu)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Kas $kas, Request $request)
    {
        //service increase
        //respond
    }


    public function decrease(Kas $kas, Request $request)
    {
        //service decrease
        //respond
    }
}
