<?php

namespace App\Http\Controllers;

use App\Contracts\Tenongan\TenonganService;
use App\Exports\PenjualanExport;
use Illuminate\Http\Request;
use Excel;

class TestController extends Controller
{
    //
    protected $tenonganService;

    public function __construct(TenonganService $tenonganService)
    {
        $this->tenonganService = $tenonganService;
    }
    public function index(Request $request)
    {
        return response('test');
    }
    public function test(Request $request)
    {
        return Excel::download(new PenjualanExport,'coba.xlsx');
    }
}
