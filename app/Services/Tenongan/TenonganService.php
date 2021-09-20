<?php

namespace App\Services\Tenongan;

use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\Transaksi;
use App\Repositories\Tenongan\PenjualanRepository;
use App\Repositories\Tenongan\TransaksiRepository;
use App\Repositories\Tenongan\SaldoRepository;

class TenonganService implements TenonganServiceContract
{
    protected $penjualanRepository;
    protected $transaksiRepository;
    protected $saldoRepository;

    public function __construct()
    {
        $this->penjualanRepository = new PenjualanRepository;
        $this->saldoRepository = new SaldoRepository;
        $this->transaksiRepository = new TransaksiRepository;
    }
    public function tambahPenjualan(array $attribute)
    {
        $this->penjualanRepository->tambah($attribute);
    }
    public function transact()
    {
        Penjualan::whereStatus('Draft')->chunk(100, function ($penjualans) {
            foreach ($penjualans as $key => $penjualan) {
                $this->transaksiRepository->setOwner($penjualan->produk->produsen)->firstOrCreate();
                $jumlah = $penjualan->laku * $penjualan->harga_beli;
                $penjualan->status = 'pending';
                $this->transaksiRepository->tambahJumlahTransaksi($jumlah);
                $penjualan->save();
            }
        });
    }

    public function pay()
    {
        //ganti status pending di transaksi & penjualan
        // $this->transaksiRepository->pay();


        Penjualan::whereStatus('Pending')->chunkById(100, function ($penjualans) {
            foreach ($penjualans as $key => $penjualan) {
                $jumlah = $penjualan->harga_beli * $penjualan->laku;
                $saldo = $penjualan->pedagang->saldo;
                $this->saldoRepository->setSaldo($saldo)->decrease(['jumlah' => $jumlah]);
                $penjualan->status = "Ok";
                $penjualan->save();
            }
        });
        Transaksi::whereStatus('Pending')->chunkById(100, function ($transaksis) {
            foreach ($transaksis as $key => $transaksi) {
                $transaksi->status = "Ok";
                $transaksi->save();
            }
        });
    }
}
