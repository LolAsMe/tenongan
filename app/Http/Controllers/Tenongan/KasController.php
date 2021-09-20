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
        $kas = $this->kasRepository->getKas();
        return response()->json($kas);
    }

    public function show(Kas $kas)
    {
        //
        return response()->json($kas->load(['log', 'log.payer']));

    }

    public function store(Request $request)
    {
        //
        $kas = $request->all();
        $kas = Kas::create($kas);
        return response()->json($kas);
    }

    /**
     * Menambahkan jumlah kas(detail sudah termaasu)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Request $request)
    {
        $this->kasRepository->findPayer($request->all());
        return $this->kasRepository->increase($request->all())->getLogKas();
    }

    public function decrease(Request $request)
    {
        $this->kasRepository->findPayer($request->all());
        return $this->kasRepository->decrease($request->all())->getLogKas();
    }
}
