<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\PenjualanRepository as PenjualanRepositoryContract;
use App\Models\Tenongan\Kas;
use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\Produk;
use Illuminate\Database\Eloquent\Model;

/**
 * kas Repositry with eloquent
 * mengatur kas + log kas
 */
class PenjualanRepository implements PenjualanRepositoryContract
{
    /**
     * Menambah penjualan Bulk
     *
     * @param array $attribute
     * @return void
     */
    public function tambah(array $data)
    {
        foreach ($data as $key => $value) {
            $this->titip($value);
        }
    }


    protected function getHargaJual($id)
    {
        $produk = Produk::find($id);
        return $produk->harga_jual;
    }

    protected function getHargaBeli($id)
    {
        $produk = Produk::find($id);
        return $produk->harga_beli;
    }

    public function titip(array $attribute){
        $penjualan = new Penjualan;
        $penjualan->kode = $attribute['kode'];
        $penjualan->produk_id = $attribute['produk_id'];
        $penjualan->titip = $attribute['titip'];
        $penjualan->laku = $attribute['laku'];
        $penjualan->pedagang_id = $attribute['pedagang_id'];
        $penjualan->tanggal =now();
        $penjualan->harga_beli = $this->getHargaBeli($attribute['produk_id']);
        $penjualan->harga_jual = $this->getHargaJual($attribute['produk_id']);
        $penjualan->save();
    }
}
