<?php

namespace App\Http\Controllers\Tenongan;

use App\Contracts\Tenongan\TenonganService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaldoIncreaseRequest;
use App\Models\Tenongan\Pedagang;
use Illuminate\Http\Request;

class PedagangController extends Controller
{
    protected $tenonganService;
    public function __construct(TenonganService $tenonganService) {
        $this->tenonganService = $tenonganService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedagang = Pedagang::all();
        return response()->json($pedagang);
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
        $pedagang = $this->tenonganService->createPedagang($request->all());
        return response()->json($pedagang);

    }

    /**
     * Display the Penjualan from spesific Pedagang.
     *
     * @param  \App\Models\Tenongan\Pedagang  $produsen
     * @return \Illuminate\Http\Response
     */
    public function penjualan(Pedagang $pedagang)
    {
        //
        return response()->json($pedagang->penjualan()->with(['produk:id,nama','pedagang:id,nama'])->get());
    }


    /**
     * Display the transaksi from spesific Pedagang.
     *
     * @param  \App\Models\Tenongan\Pedagang  $pedagang
     * @return \Illuminate\Http\Response
     */
    public function transaksi(Pedagang $pedagang)
    {
        //
        return response()->json($pedagang->transaksi()->with('owner:id,nama')->get());
    }
    /**
     * Display the saldo from spesific Pedagang.
     *
     * @param  \App\Models\Tenongan\Pedagang  $pedagang
     * @return \Illuminate\Http\Response
     */
    public function saldo(Pedagang $pedagang)
    {
        //
        return response()->json($pedagang->saldo()->with('log')->first());
    }
    /**
     * Display the harian from spesific Pedagang.
     *
     * @param  \App\Models\Tenongan\Pedagang  $pedagang
     * @return \Illuminate\Http\Response
     */
    public function harian(Pedagang $pedagang)
    {
        //
        return response()->json($pedagang->kasHarian()->with('payer:id,nama')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenongan\Pedagang  $pedagang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedagang $pedagang)
    {
        //
        $data = $request->all();
        $pedagang->update($data);
        return response()->json($pedagang);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenongan\Pedagang  $pedagang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedagang $pedagang)
    {
        //
        $pedagang->delete();
    }

    /**
     * Tambah saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(SaldoIncreaseRequest $request,Pedagang $pedagang)
    {
        $test = $pedagang->saldo->increase($request->jumlah,$request->validated());
        return $test;
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
        $test = $pedagang->saldo->decrease($request->jumlah,$request->all());
    }
}
