<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Models\tenongan\Penjualan;
use Illuminate\Http\Request;
use App\Contracts\Tenongan\TenonganService;
use App\Http\Resources\PenjualanResource;
use App\Http\Resources\TransaksiResource;
use App\Models\Tenongan\TempFile;
use App\Models\Tenongan\Transaksi;
use App\Services\Tenongan\TempService;
use DebugBar\DebugBar;

class PenjualanController extends Controller
{
    protected $tenongan;
    public function __construct(TenonganService $tenongan)
    {
        $this->tenongan = $tenongan;
    }

    public function titip(Request $request)
    {
        $penjualans = $this->tenongan->createPenjualans(json_decode($request->getContent(), true));
        return response()->json(json_decode($request->getContent(), true));
    }
    /**
     * menghitung transaksi yang terjadi, status pendinng
     *
     * @return void
     */
    public function transact()
    {
        $response = $this->tenongan->transact();
        return response()->json($response);
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
        $transaksi = Transaksi::with('owner:id,nama')->latest()->get();
        return TransaksiResource::collection($transaksi);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        //
        $penjualan = Penjualan::with(['produk:id,nama', 'pedagang:id,nama'])->latest()->take(20)->get();
        return PenjualanResource::collection($penjualan);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index3(TempService $tempService)
    {
        DebugBar()->info($tempService->getTempFile());
        return response()->json($tempService->getTempFile());
    }

    public function tempConclude(TempService $tempService)
    {
        $tempService->conclude();
        return 'berhasil';
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
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request, Transaksi $transaksi)
    {
        //
        $transaksi->tambah($request->jumlah, $request->all());
        // $transaksi->increment('jumlah', $request->jumlah);
        // $transaksi->detail()->create($request->all());
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
        // dd($transaksi->kasHarian);
        return new TransaksiResource($transaksi->load(['penjualan.produk', 'detail', 'kasHarian']));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tenongan\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function tempDelete(TempFile $tempFile)
    {
        //

        debugbar()->info($tempFile->delete());
        return 'berhasil';
    }
    public function tempClear()
    {
        //
        TempFile::truncate();
        return 'berhasil';
    }
    public function reset()
    {
        $this->tenongan->resetPenjualan();
    }
}
