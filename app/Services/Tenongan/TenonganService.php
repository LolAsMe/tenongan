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
use App\Traits\Tenongan\RutinitasServiceTrait;
use Illuminate\Support\Collection;

class TenonganService implements TenonganServiceContract
{
    use KasServiceTrait;
    use PedagangServiceTrait;
    use RutinitasServiceTrait;
    use ProdusenServiceTrait;
    use PenjualanServiceTrait;

    public $transaksi;

    public function __construct()
    {
        $this->kas = new Kas();
        $this->transaksis = new Collection();
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
        Penjualan::whereStatus('Draft')->with(['produk', 'pedagang'])->chunk(100, function ($penjualans) {
            foreach ($penjualans as $key => $penjualan) {
                try {
                    $penjualan->pedagang->nama;
                    $penjualan->produk->nama;
                } catch (\Throwable $th) {
                    throw $th;
                }
                $jumlah = $penjualan->laku * $penjualan->harga_beli;
                $transaksi = $penjualan->produk->produsen->transaksi()->firstOrCreate(
                    [
                        'status' => 'Pending'
                    ],
                    [
                        'jumlah' => 0,
                        'keterangan' => $penjualan->keterangan
                    ]
                );
                $transaksi->increment('jumlah', $jumlah);
                $transaksi->penjualan()->save($penjualan);
                $this->transaksis->push($transaksi);

                $jumlah = $penjualan->laku * ($penjualan->harga_jual - $penjualan->harga_beli);
                $transaksi = $penjualan->pedagang->transaksi()->firstOrCreate(
                    [
                        'status' => 'Pending'
                    ],
                    [
                        'jumlah' => 0,
                        'keterangan' => $penjualan->keterangan
                    ]
                );
                $transaksi->increment('jumlah', $jumlah);
                $transaksi->penjualan()->save($penjualan);

                $penjualan->status = 'Pending';
                $penjualan->save();
                $this->transaksis->push($transaksi);
            }
        });
        $this->transaksis->each(function ($transaksi) {
            $kas = $transaksi->kasHarian()->whereStatus('pending')->first();
            if (!$kas) {
                $kas = $transaksi->kasHarian()->create(['status' => 'Pending', 'jumlah' => 1000]);
                $transaksi->decrement('jumlah', $kas->jumlah);
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

        // $this->setKas();
        // $this->kas->createLog(['keterangan' => 'Penambahan dari Penjualan Harian']);
        // KasHarian::whereStatus('Pending')->chunkById(100, function ($kasHarians) {
        //     foreach ($kasHarians as $kasHarian) {
        //         $this->kas->increment('jumlah', $kasHarian->jumlah);
        //         $this->kas->getLastLog()->increment('jumlah', $kasHarian->jumlah);
        //         $this->kas->getLastLog()->save();
        //         $this->kas->getLastLog()->kasHarian()->save($kasHarian);

        //         $saldo = new Saldo();
        //         if ($kasHarian->tipe == 'Pedagang') {
        //             $saldo = $kasHarian->payer->saldo;
        //         } else {
        //             $saldo = $kasHarian->payer->produsen->saldo;
        //         }
        //         $saldo->decrease($kasHarian->jumlah, ['keterangan' => 'Kurang dari potongan harian']);

        //         $kasHarian->status = 'Ok';
        //         $kasHarian->save();
        //     }
        // });
    }
    public static function toCurrency($value)
    {
        return "Rp " . number_format($value, 2, ',', '.');
    }
}
