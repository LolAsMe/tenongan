<?php

namespace App\Services\Tenongan;

use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Models\Tenongan\KasHarian;
use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\Saldo;
use App\Models\Tenongan\Transaksi;
use App\Repositories\Tenongan\KasHarianRepository;
use App\Repositories\Tenongan\KasRepository;
use App\Repositories\Tenongan\PenjualanRepository;
use App\Repositories\Tenongan\TransaksiRepository;
use App\Repositories\Tenongan\SaldoRepository;

class TenonganService implements TenonganServiceContract
{
    protected $penjualanRepository;
    protected $transaksiRepository;
    protected $kasRepository;
    protected $saldoRepository;

    public function __construct()
    {
        $this->penjualanRepository = new PenjualanRepository;
        $this->saldoRepository = new SaldoRepository;
        $this->transaksiRepository = new TransaksiRepository;
        $this->kasRepository = new KasRepository;
    }
    public function tambahPenjualan(array $attribute)
    {
        $this->penjualanRepository->tambah($attribute);
    }
    public function transact()
    {
        Penjualan::whereStatus('Draft')->chunk(100, function ($penjualans) {
            foreach ($penjualans as $key => $penjualan) {
                $jumlah = $penjualan->laku * $penjualan->harga_beli;
                $this->transaksiRepository->setOwner($penjualan->produk->produsen)->firstOrCreate();
                $this->transaksiRepository->tambahJumlahTransaksi($jumlah)->attachPenjualan($penjualan);

                $jumlah = $penjualan->laku * ($penjualan->harga_jual-$penjualan->harga_beli);
                $this->transaksiRepository->setOwner($penjualan->pedagang)->firstOrCreate();
                $this->transaksiRepository->tambahJumlahTransaksi($jumlah)->attachPenjualan($penjualan);
                $this->kasRepository->setPayer($penjualan->produk)->firstOrCreateHarian(['jumlah' => 1000]);
                $this->kasRepository->setPayer($penjualan->pedagang)->firstOrCreateHarian(['jumlah' => 1000]);


                $penjualan->status = 'Pending';
                $penjualan->save();
            }
        });
    }

    public function pay()
    {
        //ganti status pending di transaksi & penjualan
        // $this->transaksiRepository->pay();


        // Penjualan::whereStatus('Pending')->chunkById(100, function ($penjualans) {
        //     foreach ($penjualans as $key => $penjualan) {
        //         $jumlah = $penjualan->harga_beli * $penjualan->laku;
        //         $saldo = $penjualan->pedagang->saldo;
        //         $this->saldoRepository->setSaldo($saldo)->decrease(['jumlah' => $jumlah]);
        //         $penjualan->status = "Ok";
        //         $penjualan->save();
        //     }
        // });

        Transaksi::whereStatus('Pending')->chunkById(100, function ($transaksis) {
            foreach ($transaksis as $key => $transaksi) {
                $this->transaksiRepository->setTransaksi($transaksi)->pay();
                // dd($transaksi->penjualan);
                // $transaksi->status = "Ok";
                // $transaksi->save();
            }
        });

        $this->kasRepository->createLog(['keterangan'=>'Kas Harian Produsen & Pedagang']);
        KasHarian::whereStatus('Pending')->chunkById(100, function ($kasHarians) {
            foreach ($kasHarians as $key => $kasHarian) {
                $this->kasRepository->setKasHarian($kasHarian)->pay();
                $saldo = new Saldo();
                if ($kasHarian->tipe == 'Pedagang') {
                    $saldo = $kasHarian->payer->saldo;
                }else{
                    $saldo = $kasHarian->payer->produsen->saldo;
                }

                $saldo->jumlah -= $kasHarian->jumlah;
                $saldo->save;

                $this->saldoRepository
                ->setSaldo($saldo)
                ->decrease(['jumlah'=>$kasHarian->jumlah, 'keterangan'=>'Kurang dari potongan harian']);
                // $kasHarian->status = "Ok";
                // $kasHarian->save();
            }
        });
    }
}
