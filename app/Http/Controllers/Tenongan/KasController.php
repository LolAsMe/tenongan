<?php

namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Contracts\Tenongan\TenonganService;
use App\Http\Resources\KasHarianResource;
use App\Http\Resources\KasResource;
use App\Models\Tenongan\Kas;
use App\Models\Tenongan\KasHarian;
use Illuminate\Http\Request;

class KasController extends Controller
{


    protected $tenonganService;

    public function __construct(TenonganService $tenonganService)
    {
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
        $kas = Kas::all();

        dd($kas);
        // return new KasResource($kas);
    }

    public function harian()
    {
        //
        $harians = KasHarian::with('payer')->latest()->get();
        return KasHarianResource::collection($harians);
    }
    public function show(Kas $kas)
    {
        //
        return response()->json($kas->load(['log', 'log.payer']));
    }
    public function store(Request $request)
    {
        //
        // $kas = $request->all();
        // $kas = Kas::create($kas);
        // return response()->json($kas);
        $datas = [
            ['transaksi_id' => '357', 'jumlah' => 10000],
            ['transaksi_id' => '357', 'jumlah' => 20000],
            ['transaksi_id' => '357', 'jumlah' => 30000],
            ['transaksi_id' => '357', 'jumlah' => 15000],
            ['transaksi_id' => '357', 'jumlah' => 10000],
            ['transaksi_id' => '357', 'jumlah' => 40000],
        ];
        $kas = Kas::create();
        // dd($datas);
        $kas->addDetail($datas);
    }
    /**
     * Menambahkan jumlah kas(detail sudah termaasu)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Request $request)
    {
        $this->tenonganService->setKas()->increaseKas($request->all());
        return $this->tenonganService->getLogKas();
    }

    public function decrease(Request $request)
    {
        $this->tenonganService->setKas()->decreaseKas($request->all());
        return $this->tenonganService->getLogKas();
    }
}
