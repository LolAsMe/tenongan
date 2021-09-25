<?php

namespace App\Traits\Tenongan;

use App\Models\Tenongan\Penjualan;
use App\Models\Tenongan\Produk;

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
        $ids = array_column($dataPenjualan,'produk_id');
        $produk = Produk::findMany($ids);
        foreach ($dataPenjualan as $key => $data) {
            $data['harga_beli'] = $produk->find($data['produk_id'])->harga_beli;
            $data['harga_jual'] = $produk->find($data['produk_id'])->harga_jual;
            $penjualan = Penjualan::create($data);
            array_push($this->penjualans, $penjualan);
        }
        return $this->penjualans;
	}
}
