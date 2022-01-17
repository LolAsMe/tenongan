<?php

namespace App\Services\Tenongan;

use App\Models\Tenongan\Pembulatan;
use App\Models\Tenongan\Transaksi;

class PembulatanService
{
    public $transaksi;
    public $bulatan;

    public function __construct()
    {
        $transaksi = new Transaksi();
        $bulatan = new Pembulatan();
    }

    public function HandlePembulatanTransaksi(Transaksi $transaksi)
    {
        if($transaksi->owner_type == "Produsen"){

            // dd($transaksi);
            // dd($transaksi->owner->bulatan);
        $this->transaksi = $transaksi->load('owner');

        // cek kemarin
        $this->handleKemarin();
        $this->handleBulatan();
        // debugbar()->info(Pembulatan::find(0));
        // apply database + kemarin
        // Dibulakan
        // create Database
        // dd(Pembulatan::all());
    }
        return 'berhasil';
    }

    public function handleBulatan()
    {
        $pembulatan = $this->bulat($this->transaksi->jumlah);
        $this->transaksi->jumlah += $pembulatan;
        $this->transaksi->pembulatan = $pembulatan;
        $this->bulatan->jumlah = $pembulatan;
        $this->transaksi->save();
        $this->bulatan->save();
    }

    public function bulat($jumlah)
    {
        if($jumlah<1000){
            return 0;
        }
        if($jumlah%1000 != 0){
            $bulatan = 1000 - $jumlah%1000;
            $jumlah = $jumlah + $bulatan;
            return $bulatan;
        }
        return 0;
    }

    public function getKemarin()
    {
        $this->bulatan = $this->transaksi->owner->bulatan ?? Pembulatan::create(['produsen_id'=>$this->transaksi->owner->id]);
    }

    public function handleKemarin()
    {
        $this->getKemarin();
        $kemarin = 0;
        if($this->bulatan){
            $kemarin = $this->bulatan->jumlah;
        }else{
            $kemarin = 0;
        }
        $this->transaksi->jumlah -= $kemarin;
        $this->transaksi->kemarin = $kemarin;
    }
}
