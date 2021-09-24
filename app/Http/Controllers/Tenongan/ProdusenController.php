<?php

namespace App\Http\Controllers\Tenongan;

use App\Contracts\Tenongan\TenonganService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaldoIncreaseRequest;
use App\Models\Tenongan\Produsen;

use Illuminate\Http\Request;
class ProdusenController extends Controller
{

    protected $tenonganService;
     function __construct(TenonganService $tenonganService) {
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
        $produsen = Produsen::all();
        return response()->json($produsen);
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
        $produsen = $this->tenonganService->createProdusen($request->all());
        return response()->json($produsen);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function show(Produsen $produsen)
    {
        //
        return response()->json($produsen->load('produk'));
    }


    /**
     * Display Produk from spesific Produsen.
     *
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function produk(Produsen $produsen)
    {
        //
        return response()->json($produsen->produk);
    }

    /**
     * Display the transaksi from spesific Produsen.
     *
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function transaksi(Produsen $produsen)
    {
        //
        return response()->json($produsen->transaksi()->with('owner:id,nama')->get());
    }
    /**
     * Display the saldo from spesific Produsen.
     *
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function saldo(Produsen $produsen)
    {
        //
        return response()->json($produsen->saldo()->with('log')->first());
    }
    /**
     * Display the harian from spesific Produsen.
     *
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function harian(Produsen $produsen)
    {
        //
        return response()->json($produsen->kasHarian()->with('payer:id,nama')->get());
    }

    /**
     * Display the Penjualan from spesific Produsen.
     *
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function penjualan(Produsen $produsen)
    {
        //
        return response()->json($produsen->penjualan()->with(['pedagang:id,nama','produk:id,nama'])->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produsen $produsen)
    {
        //
        $data = $request->all();
        $produsen->update($data);
        return response()->json($produsen);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenongan\Produsen  $produsen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produsen $produsen)
    {
        //
        $produsen->delete();
    }
    /**
     * Tambah saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(SaldoIncreaseRequest $request,Produsen $produsen)
    {
        $test = $produsen->saldo->increase($request->jumlah,$request->validated());
        return $test;
    }

    /**
     * Kurang Saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function decrease( Request $request, Produsen $produsen)
    {
        $test = $produsen->saldo->decrease($request->jumlah,$request->all());
    }
}
