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
    protected $penjualanAttribute;
    protected $penjualan;

    public function __construct(?Penjualan $penjualan=null) {
        $this->penjualan = $penjualan;
    }

    public function setPenjualanAttribute(?array $attribute=null)
    {
        $this->penjualanAttribute['produk_id'] = $attribute['produk_id'];
        $this->penjualanAttribute['titip'] = $attribute['titip'];
        $this->penjualanAttribute['laku'] = $attribute['laku'] ?? null;
        $this->penjualanAttribute['pedagang_id'] = $attribute['pedagang_id'];
        $this->penjualanAttribute['status'] =$attribute['status'] ?? 'Draft';
        $this->penjualanAttribute['tanggal'] = $attribute['tanggal'] ?? now();
        $this->penjualanAttribute['harga_beli'] = $this->getHargaBeli($attribute['produk_id']);
        $this->penjualanAttribute['harga_jual'] = $this->getHargaJual($attribute['produk_id']);

        return $this;
    }

    public function getPenjualanAttribute()
    {
        return $this->penjualanAttribute;
    }

    public function setPenjualan(Penjualan $penjualan)
    {
        $this->penjualan = $penjualan;
    }

    public function createPenjualan(?array $attribute = null)
    {
        if (isset($attribute)) {
            $this->setPenjualanAttribute($attribute);
            $penjualan = Penjualan::create($this->getPenjualanAttribute());
            $this->setPenjualan($penjualan);
        }else{
            $penjualan = Penjualan::create($this->getPenjualanAttribute());
            $this->setPenjualan($penjualan);
        }
    }

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
        $this->setPenjualanAttribute($attribute);
        $this->createPenjualan();
    }
}
