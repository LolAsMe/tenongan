<?php

namespace App\Services\Tenongan;

use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Traits\Tenongan\KasServiceTrait;

use App\Models\Tenongan\Kas;
use App\Models\Tenongan\KasHarian;
use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\Saldo;
use App\Models\Tenongan\Transaksi;
use App\Traits\Tenongan\PedagangServiceTrait;
use App\Traits\Tenongan\PenjualanServiceTrait;
use App\Traits\Tenongan\ProdusenServiceTrait;

class TenonganService implements TenonganServiceContract
{
    use KasServiceTrait;
    use PedagangServiceTrait;
    use ProdusenServiceTrait;
    use PenjualanServiceTrait;

    public function __construct()
    {
        $this->kas = new Kas();
    }

    public function increaseSaldo(array $attribute)
    {

    }

    public function decreaseSaldo(array $attribute)
    {

    }

    public function test()
    {
        # code...
    }


    public function transact()
    {

        Penjualan::whereStatus('Draft')->chunk(100, function ($penjualans) {
            foreach ($penjualans as $key => $penjualan) {
                $jumlah = $penjualan->laku * $penjualan->harga_beli;
                $transaksi = $penjualan->produk->produsen->transaksi()->firstOrCreate(
                    [
                        'status' => 'Pending'
                    ],
                    [
                        'jumlah' => $jumlah,
                        'keterangan' => $penjualan->keterangan
                    ]
                );
                $transaksi->increment('jumlah', $jumlah);
                $transaksi->penjualan()->save($penjualan);

                $jumlah = $penjualan->laku * ($penjualan->harga_jual - $penjualan->harga_beli);
                $transaksi = $penjualan->pedagang->transaksi()->firstOrCreate(
                    [
                        'status' => 'Pending'
                    ],
                    [
                        'jumlah' => $jumlah,
                        'keterangan' => $penjualan->keterangan
                    ]
                );
                $transaksi->increment('jumlah', $jumlah);
                $transaksi->penjualan()->save($penjualan);

                $penjualan->pedagang->kasHarian()->firstOrCreate(
                    ['status' => 'Pending'],
                    ['jumlah' => 1000]
                );
                $penjualan->produk->kasHarian()->firstOrCreate(
                    ['status' => 'Pending'],
                    ['jumlah' => 1000]
                );

                $penjualan->status = 'Pending';
                $penjualan->save();
            }
        });
    }

    public function pay()
    {
        Transaksi::whereStatus('Pending')->with(['owner.saldo'])->chunkById(100, function ($transaksis) {
            $keterangan = 'Penambahan penjualan harian';
            foreach ($transaksis as $key => $transaksi) {
                $transaksi->owner->saldo->increase($transaksi->jumlah, compact('keterangan'));
                $transaksi->status = 'Ok';
                $transaksi->save();
            }
        });

        Penjualan::whereStatus('Pending')->chunkById(100, function ($penjualans) {
            foreach ($penjualans as $penjualan) {
                $penjualan->status = 'Ok';
                $penjualan->save();
            }
        });

        $this->setKas();
        $this->kas->createLog(['keterangan' => 'Penambahan dari Penjualan Harian']);
        KasHarian::whereStatus('Pending')->chunkById(100, function ($kasHarians) {
            foreach ($kasHarians as $kasHarian) {
                $this->kas->increment('jumlah', $kasHarian->jumlah);
                $this->kas->getLastLog()->increment('jumlah', $kasHarian->jumlah);
                $this->kas->getLastLog()->save();
                $this->kas->getLastLog()->kasHarian()->save($kasHarian);

                $saldo = new Saldo();
                if ($kasHarian->tipe == 'Pedagang') {
                    $saldo = $kasHarian->payer->saldo;
                } else {
                    $saldo = $kasHarian->payer->produsen->saldo;
                }
                $saldo->decrease($kasHarian->jumlah, ['keterangan' => 'Kurang dari potongan harian']);

                $kasHarian->status = 'Ok';
                $kasHarian->save();
            }
        });
    }
}
