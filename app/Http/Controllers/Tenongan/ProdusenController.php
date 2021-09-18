<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Models\Tenongan\Produsen;
use Illuminate\Http\Request;

class ProdusenController extends Controller
{
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
        $produsen = $request->all();
        $produsen = Produsen::create($produsen);
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
}
