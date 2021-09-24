<?php
namespace App\Http\Controllers\Tenongan;

use App\Http\Controllers\Controller;
use App\Contracts\Tenongan\TenonganService;
use App\Models\Tenongan\Kas;
use App\Models\Tenongan\KasHarian;
use Illuminate\Http\Request;

class KasController extends Controller
{


    protected $tenonganService;

    public function __construct(TenonganService $tenonganService) {
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
        $kas = $this->tenonganService->setKas()->getKas()->load('log');
        return response()->json($kas);
    }

    public function harian()
    {
        //
        $harians = KasHarian::with('payer')->latest()->get();
        return response()->json($harians);
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
        $this->tenonganService->setKas()->increaseKas($request->all());
        return $this->tenonganService->getLogKas();
    }

    public function decrease(Request $request)
    {
        $this->tenonganService->setKas()->decreaseKas($request->all());
        return $this->tenonganService->getLogKas();
    }
}
