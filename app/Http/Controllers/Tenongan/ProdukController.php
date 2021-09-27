<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Models\Tenongan\Produk;
use Illuminate\Http\Request;
use App\Services\SpreadsheetService;

class ProdukController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produk = Produk::with('produsen')->get();
        return response()->json($produk);
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
        $produk = $request->all();
        $produk = Produk::create($produk);
        return response()->json($produk->load('produsen'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenongan\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
        return response()->json($produk->load('produsen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenongan\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //
        $data = $request->all();
        $produk->update($data);
        return response()->json($produk->load('produsen'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenongan\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
        $produk->delete();
    }
}
