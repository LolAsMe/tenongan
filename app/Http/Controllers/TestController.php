<?php

namespace App\Http\Controllers;

use App\Contracts\Tenongan\TenonganService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    protected $tenonganService;
    public function __construct(TenonganService $tenonganService) {
        $this->tenonganService = $tenonganService;
    }
    public function index(Request $request)
    {
        dd($request->user());
    }
}
