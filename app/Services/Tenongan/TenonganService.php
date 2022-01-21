<?php

namespace App\Services\Tenongan;

use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Traits\Tenongan\KasServiceTrait;

use App\Models\Tenongan\Kas;
use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\TempFile;
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

    public $rutinitas;
    public $transaksis;
    public $pembulatanService;
    public $kasService;

    public function __construct(Rutinitas $rutinitas)
    {
        $this->rutinitas = $rutinitas;
        $this->kas = new Kas();
        $this->pembulatanService = new PembulatanService();
        $this->transaksis = new Collection();
        $this->kasService = new KasService();
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


        $this->kasService->handleTransaksis($this->transaksis);

        // $newTransaksis = $this->transaksis->unique('id');
        // $newTransaksis->each(function ($transaksi) {
        // $kas = Kas::firstOrCreate(
        //     [
        //         'status' => 'Pending'
        //     ],
        //     [
        //         'jumlah' => 0,
        //         'keterangan' => ''
        //     ]
        // );
        // $detail = $kas->detail()->whereStatus('Pending')->get();
        // debugbar()->info($transaksi->toArray());
        // $kas->addDetail($transaksi);
        // debugbar()->info($kas);
        // $kas = $transaksi->kasHarian()->whereStatus('pending')->first();
        // if (!$kas) {
        //     $kas = $transaksi->kasHarian()->create(['status' => 'Pending', 'jumlah' => 1000]);
        //     $transaksi->decrement('jumlah', $kas->jumlah);
        // }
        // if ($this->checkRutinitas($transaksi->owner)) {
        //     foreach ($transaksi->owner->rutinitas as $key => $oneRutinitas) {
        //         $attribute = $oneRutinitas->attributesToArray();
        //         $transaksi->tambah($attribute['jumlah'], $attribute);
        //     }
        // }
        // debugbar()->info($this->checkRutinitas($transaksi->owner));



        // });
        // return "berhasil";
    }

    public function checkRutinitas($owner): bool
    {
        return !$owner->rutinitas->isEmpty();
    }

    public function pay()
    {
        Transaksi::whereStatus('Pending')->with(['owner.saldo'])->chunkById(100, function ($transaksis) {
            $keterangan = 'Penambahan penjualan harian';
            foreach ($transaksis as $key => $transaksi) {
                $transaksi->owner->saldo->increase($transaksi->jumlah, compact('keterangan'));
                $transaksi->status = 'Ok';
                $transaksi->save();

                if ($this->checkRutinitas($transaksi->owner)) {
                    foreach ($transaksi->owner->rutinitas as $key => $oneRutinitas) {
                        $attribute = $oneRutinitas->attributesToArray();
                        $transaksi->tambah($attribute['jumlah'], $attribute);
                    }
                }
                $this->pembulatanService->handlePembulatanTransaksi($transaksi);
            }
        });

        Penjualan::whereStatus('Pending')->chunkById(100, function ($penjualans) {
            foreach ($penjualans as $penjualan) {
                $penjualan->status = 'Ok';
                $penjualan->save();
            }
        });

        $this->kasService->finalizeData();
    }
    public static function toCurrency($value)
    {
        return "Rp " . number_format($value, 2, ',', '.');
    }

    public static function numerize($value)
    {
        return number_format($value, 0, ',', '.');
    }

    public static function getTempFile()
    {
        $penjualan = TempFile::all();
        $penjualan->each(function ($penjualan) {
            $penjualan['data'] = json_decode($penjualan['data'], true);
        });
        return $penjualan;
    }
}
