<?php
namespace App\Repositories\Tenongan;

use App\Models\Tenongan\Kas;
use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\Transaksi;

/**
 *
 */
class TransaksiRepository
{
    protected $saldoRepository;
    protected $kasRepository;

    public function __construct() {
        $this->saldoRepository = new SaldoRepository;
        $this->kasRepository = new KasRepository;
    }
    /**
     * Melakukan Transaksi
     *
     * @return void
     */
    public function transact()
    {
        // $this->checkPrevTransct();
        Penjualan::whereStatus('Draft')->chunk(100,function($penjualans){
            foreach ($penjualans as $key => $penjualan) {
                $transaksi = Transaksi::firstOrCreate([
                    "produsen_id" => $penjualan->produk->produsen_id,"tanggal"=>date("Y-m-d"),"status"=>'Pending'
                ],["jumlah" => 0]);
                $jumlah = $penjualan->laku * $penjualan->harga_beli;
                $penjualan->status='pending';
                $transaksi->jumlah += $jumlah;
                $transaksi->penjualan()->save($penjualan);
                $transaksi->save();
                $penjualan->save();
            }
        });
    }

    /**
     * Mengecek apakah ada transaksi yang berstatus pending, apabila ada dihapus
     *
     * @return void
     */
    public function checkPrevTransct()
    {
        if($transaksi = Transaksi::whereStatus('Pending')){
            $transaksi->forceDelete();
        }else{
        }
    }

    /**
     * Menmbayar uang yang masih pending,
     *
     * @return void
     */
    public function pay()
    {
        Penjualan::whereStatus('Pending')->chunkById(100,function($penjualans){
            foreach ($penjualans as $key => $penjualan) {
                $tanggungan = $penjualan->harga_beli*$penjualan->laku;
                $saldo = $penjualan->pedagang->saldo;
                $this->saldoRepository->setSaldo($saldo)->decrease(['jumlah'=>$tanggungan]);
                $penjualan->status = "Ok";
                $penjualan->save();
            }
        });
        Transaksi::whereStatus('Pending')->chunkById(100,function($transaksis){
            foreach ($transaksis as $key => $transaksi) {
                $transaksi->status = "Ok";
                $transaksi->save();
            }
        });
    }
}
