<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Models\Tenongan\Pedagang;
use Illuminate\Http\Request;

class PedagangController extends Controller
{
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
        $pedagang = $request->all();
        pedagang::create($pedagang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenongan\Pedagang  $pedagang
     * @return \Illuminate\Http\Response
     */
    public function show(Pedagang $pedagang)
    {
        //
        return response()->json($pedagang);
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
}
