<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Contracts\Tenongan\KasRepository;
use App\Models\Tenongan\Kas;
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
        return response()->json($kas->load('logKas'));

    }

    /**
     * Menambahkan jumlah kas(detail sudah termaasu)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Kas $kas, Request $request)
    {
        //service increase
        //respond
        $this->kasRepository->increase($kas,$request->all());

    }


    public function decrease(Kas $kas, Request $request)
    {
        //service decrease
        //respond
        $this->kasRepository->decrease($kas,$request->all());
    }
}
