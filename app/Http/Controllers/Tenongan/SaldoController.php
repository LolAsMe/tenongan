<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Models\Tenongan\Saldo;
use Illuminate\Http\Request;
use App\Contracts\Tenongan\SaldoRepository;

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
        return response()->json($saldo);
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
        return response()->json($saldo->load('logSaldo'));

    }

    /**
     * Tambah saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Saldo $saldo, Request $request)
    {
        $this->saldoRepository->increase($saldo,$request->all());
    }


    /**
     * Kurang Saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function decrease(Saldo $saldo, Request $request)
    {
        $this->saldoRepository->decrease($saldo,$request->all());

    }

}
