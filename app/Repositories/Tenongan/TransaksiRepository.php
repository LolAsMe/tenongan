<?php
namespace App\Repositories\Tenongan;

use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\Transaksi;

/**
 *
 */
class TransaksiRepository
{
    public function transact()
    {
        $this->checkTransct();
        Penjualan::whereStatus('Pending')->chunkById(100,function($penjualans){
            foreach ($penjualans as $key => $penjualan) {
                $transaksi = Transaksi::firstOrCreate([
                    "produsen_id" => $penjualan->produk->produsen_id,"tanggal"=>date("Y-m-d")
                ],["jumlah" => 0,"status"=>'Pending']);
                $jumlah = $penjualan->laku * $penjualan->harga_beli;
                $transaksi->jumlah += $jumlah;
                $transaksi->save();
            }
        });
        // dd('halo');
    }

    public function checkTransct()
    {
        if(Transaksi::whereStatus('Pending')->first()){
            Transaksi::whereStatus('Pending')->first()->forceDelete();
        }else{
        }
    }
}
