<?php

namespace App\Models\Tenongan;

use App\Models\tenongan\Penjualan;
use App\Models\User;
use App\Traits\Tenongan\HasSaldo;
use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class PenjualanTransaksi extends Pivot
{
    protected $table = 'penjualan_transaksi';
    protected $guarded = [];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
