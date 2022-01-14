<?php

namespace App\Models\Tenongan;

use App\Models\tenongan\Penjualan;
use App\Models\User;
use App\Traits\Tenongan\HasSaldo;
use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class TempFile extends Model
{
    use HasFactory;

    protected $table = 'temp_file';
    protected $guarded = [];

    public function conclude()
    {
        $produks = Produk::all();
        foreach ($this->data as $key => $value) {
            $produk = $produks->find($value['produk_id']);
            Penjualan::create($value + ['harga_beli' => $produk->harga_beli, 'harga_jual' => $produk->harga_jual]);
            debugbar()->info($value + ['harga_beli' => $produk->harga_beli, 'harga_jual' => $produk->harga_jual]);
        }
        debugbar()->info($this->data);
    }
}
