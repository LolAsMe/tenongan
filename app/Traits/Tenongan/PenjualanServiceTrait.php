<?php

namespace App\Traits\Tenongan;

use App\Models\Tenongan\Penjualan;
use App\Models\Tenongan\Produk;
use App\Models\Tenongan\Transaksi;
use Illuminate\Support\Collection;

trait PenjualanServiceTrait
{
    protected Penjualan $penjualan;
    protected array $penjualans=[];

    public function getPenjualan()
    {
        return $this->penjualan;
    }

    public function createPenjualan($attribute):Penjualan
    {
        return $this->penjualan = Penjualan::create($attribute);
    }

    public function createPenjualans(array $dataPenjualan)
	{
        $produkIds = array_column($dataPenjualan,'produk_id');
        $produk = Produk::findMany($produkIds);
        $penjualans = new Collection;
        try {
            foreach ($dataPenjualan as $key => $data) {
                $data['harga_beli'] = $produk->find($data['produk_id'])->harga_beli;
                $data['harga_jual'] = $produk->find($data['produk_id'])->harga_jual;
                $penjualan = Penjualan::create($data);
                array_push($this->penjualans, $penjualan);
                $penjualans->push($penjualan);
            }
        } catch (\Throwable $th) {

            $penjualans->each(function($penjualan){
                $penjualan->forceDelete();
            });
            throw $th;
        }
        return $this->penjualans;
	}

    public function resetPenjualan()
    {
        Penjualan::whereStatus('draft')->orWhere('status','pending')->delete();
        Transaksi::whereStatus('draft')->orWhere('status','pending')->delete();
        return 'berhasil';
    }
}
