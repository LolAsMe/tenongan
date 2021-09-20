<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Contracts\Tenongan\KasRepository;
use App\Models\Tenongan\Kas;
use App\Models\Tenongan\Pedagang;
use App\Models\Tenongan\Produk;
use Illuminate\Http\Request;

class KasController extends Controller
{

    protected $kasRepository;

    public function __construct(KasRepository $kasRepository) {
        $this->kasRepository = $kasRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kas = Kas::all();
        return response()->json($kas);
    }

    public function show(Kas $kas)
    {
        //
        return response()->json($kas->load(['log', 'log.payer']));

    }

    /**
     * Menambahkan jumlah kas(detail sudah termaasu)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Kas $kas,Produk $produk, Request $request)
    {
        //service increase
        //respond
        $this->kasRepository->increase($kas,$request->all(),$produk);

    }

    public function increase2(Kas $kas,Pedagang $pedagang, Request $request)
    {
        //service increase
        //respond
        $this->kasRepository->increase($kas,$request->all(),$pedagang);

    }


    public function decrease(Kas $kas, Request $request)
    {
        $this->kasRepository->decrease($kas,$request->all());
    }
}
