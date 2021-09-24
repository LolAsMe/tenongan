<?php
namespace App\Http\Controllers\Tenongan;
use App\Http\Controllers\Controller;
use App\Models\Tenongan\Saldo;
use Illuminate\Http\Request;
use App\Contracts\Tenongan\TenonganService;
use App\Http\Requests\SaldoIncreaseRequest;
use App\Models\Tenongan\Pedagang;

class SaldoController extends Controller
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
        $saldo = Saldo::all();
        return response()->json($saldo->load('owner:id,nama'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenongan\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function show(Saldo $saldo)
    {
        //
        return response()->json($saldo->load(['owner:id,nama','log']));
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
        $saldo = $request->all();
        $saldo = Saldo::create($saldo);
        return response()->json($saldo->load('owner'));
    }
    public function destroy(Saldo $saldo)
    {
        //
        $saldo->delete();
    }

    /**
     * Tambah saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function increase(SaldoIncreaseRequest $request,Pedagang $pedagang)
    {
        $test = $this->tenonganService->increaseSaldo($request->jumlah,$request->validated());
        return $test;
    }

    /**
     * Kurang Saldo
     *
     * @param Saldo $saldo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function decrease( Request $request, Pedagang $pedagang)
    {
        $test = $this->tenonganService->decreaseSaldo($request->jumlah,$request->all());
    }

}
