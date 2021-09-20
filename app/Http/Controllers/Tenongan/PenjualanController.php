<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Models\tenongan\Penjualan;
use App\Models\tenongan\Produsen;
use Illuminate\Http\Request;
use App\Contracts\Tenongan\TenonganService;
use App\Models\Tenongan\Transaksi;

class PenjualanController extends Controller
{
    protected $tenongan;

    public function __construct(TenonganService $tenongan) {
        $this->tenongan = $tenongan;
    }

    public function titip(Request $request)
    {
        $data= json_decode($request->getContent(),true);
        $this->tenongan->tambahPenjualan($data);
        return response()->json('sukses');
    }
    /**
     * menghitung transaksi yang terjadi, status pendinng
     *
     * @return void
     */
    public function transact()
    {
        $this->tenongan->transact();
    }

    /**
     * Membayar transaksi yang masih pending. status berubah menjadi paid out
     * skenario saldo dikurangi
     *
     * @return void
     */
    public function pay()
    {
        $this->tenongan->pay();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaksi = Transaksi::whereStatus('Pending')->with('owner')->get();
        return response()->json($transaksi);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        //
        $penjualan = Penjualan::where('status','=','Pending')->orwhere('status','=','Draft')->with(['produk','pedagang'])->get();
        return response()->json($penjualan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Models\tenongan\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show2(Transaksi $transaksi)
    {
        //
        return response()->json($transaksi->load('penjualan'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tenongan\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(penjualan $penjualan)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tenongan\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tenongan\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tenongan\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(penjualan $penjualan)
    {
        //
    }
}
