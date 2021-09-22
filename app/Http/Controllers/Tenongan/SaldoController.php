<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Models\Tenongan\Saldo;
use Illuminate\Http\Request;
use App\Contracts\Tenongan\SaldoRepository;
use App\Models\Tenongan\Pedagang;

class SaldoController extends Controller
{
    protected $saldoRepository;

    public function __construct(SaldoRepository $saldoRepository) {
        $this->saldoRepository = $saldoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $saldo = Saldo::all();
        return response()->json($saldo->load('owner'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenongan\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function show(Saldo $saldo)
    {
        //
        return response()->json($saldo->load(['owner','logSaldo']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $saldo = $request->all();
        $saldo = Saldo::create($saldo);
        return response()->json($saldo->load('owner'));
    }

    public function destroy(Saldo $saldo)
    {
        //
        $saldo->delete();
    }



    /**
     * Tambah saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Request $request,Pedagang $pedagang)
    {
        $this->saldoRepository->setSaldo($pedagang->saldo)->increase($request->all());
    }


    /**
     * Kurang Saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function decrease( Request $request, Pedagang $pedagang)
    {
        $this->saldoRepository->setSaldo($pedagang->saldo)->decrease($request->all());

    }

}
