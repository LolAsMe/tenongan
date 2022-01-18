<?php

namespace App\Services\Tenongan;

use App\Models\Tenongan\Kas;
use App\Models\Tenongan\Transaksi;
use Illuminate\Support\Collection;

class KasService
{
    protected Kas $kas;
    protected Collection $transaksis;
    protected $jumlahKas;

    public function __construct()
    {
        $this->kas = new Kas();
        $this->jumlahKas = 1000;
        $this->transaksis = new Collection();
    }

    public function setKas(Kas $kas): KasService
    {
        $this->kas = $kas;
        return $this;
    }

    public function setTransaksis(Collection $transaksis): KasService
    {
        $this->transaksis = $transaksis;
        return $this;
    }

    public function getKas(): Kas
    {
        return $this->kas;
    }

    public function getTransaksis(): Collection
    {
        return $this->transaksis;
    }

    public function setPendingKas()
    {
        $this->kas = Kas::firstOrCreate(
            [
                'status' => 'Pending'
            ],
            [
                'jumlah' => 0,
                'keterangan' => ''
            ]
        );
        $this->kas->load('detail');
        return $this;
    }

    public function addTransaksi(Transaksi $transaksi): KasService
    {
        $this->transaksis->push($transaksi);
        return $this;
    }

    public function checkData(): KasService
    {
        debugbar()->info($this->transaksis);
        $this->transaksis = $this->transaksis->reverse();
        $this->transaksis = $this->transaksis->unique('id');
        $exData = $this->kas->detail;
        $this->transaksis->except($exData);
        debugbar()->info($this->transaksis);
        return $this;
    }

    public function applyData()
    {
        $this->transaksis->each(function ($transaksi) {
            $this->kas->addTempDetail(
                [
                    'transaksi_id' => $transaksi->id,
                    'jumlah' => $this->jumlahKas,
                    'keterangan' => $transaksi->keterangan,
                ]
            );
            $transaksi->jumlah -= $this->jumlahKas;
            $transaksi->save();
        });
        $this->kas->save();
    }

    public function handleTransaksis(Collection $transaksis)
    {
        $this->setPendingKas()->setTransaksis($transaksis)->checkData()->applyData();
    }

    public function finalizeData()
    {
        $this->setPendingKas();
        $this->kas->status = 'Ok';
        $this->kas->save();
    }
}
