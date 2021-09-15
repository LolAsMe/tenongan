<?php

namespace App\Services\Tenongan;

use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Models\tenongan\Penjualan;
use App\Repositories\Tenongan\PenjualanRepository;
use App\Repositories\Tenongan\TransaksiRepository;
USE App\Repositories\Tenongan\SaldoRepository;

class TenonganService implements TenonganServiceContract
{
    protected $penjualanRepository;
    protected $transaksiRepository;
    protected $saldoRepository;

    public function __construct() {
        $this->penjualanRepository = new PenjualanRepository;
        $this->saldoRepository = new SaldoRepository;
        $this->transaksiRepository = new TransaksiRepository;
    }
    public function tambahPenjualan(array $attribute)
    {
        $this->penjualanRepository->tambah($attribute);
    }
    public function transact(){
        $this->transaksiRepository->transact();
    }

    public function pay()
    {
        //ganti status pending di transaksi & penjualan
        $this->transaksiRepository->pay();
    }
}
