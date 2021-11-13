<?php

namespace App\Http\Controllers\Tenongan;


use App\Http\Controllers\Controller;
use App\Http\Resources\RutinitasResource;
use App\Models\Tenongan\Rutinitas;
use Illuminate\Http\Request;

class RutinitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return RutinitasResource::collection(Rutinitas::with(['sender'])->get());
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
        $rutinitas = Rutinitas::create($request->all());
        return response()->json($rutinitas);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rutinitas  $rutinitas
     * @return \Illuminate\Http\Response
     */
    public function show(Rutinitas $rutinitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rutinitas  $rutinitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Rutinitas $rutinitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rutinitas  $rutinitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rutinitas $rutinitas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rutinitas  $rutinitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rutinitas $rutinitas)
    {
        //
    }
}
