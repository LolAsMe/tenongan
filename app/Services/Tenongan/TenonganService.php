<?php

namespace App\Services\Tenongan;

use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Repositories\Tenongan\PenjualanRepository;
use App\Repositories\Tenongan\TransaksiRepository;

class TenonganService implements TenonganServiceContract
{
    protected $penjualanRepository;
    protected $TransaksiRepository;

    public function __construct() {
        $this->penjualanRepository = new PenjualanRepository;
        $this->TransaksiRepository = new TransaksiRepository;
    }
    public function tambahPenjualan(array $attribute)
    {
        $this->penjualanRepository->tambah($attribute);
    }
    public function transact(){

    }
}
