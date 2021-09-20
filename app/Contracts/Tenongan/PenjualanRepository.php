<?php

namespace App\Contracts\Tenongan;

use Illuminate\Database\Eloquent\Model;
use App\Models\tenongan\Penjualan;

/**
 * Saldo interface
 */
interface PenjualanRepository
{
    public function tambah(array $attribute);
    public function create(array $attribute);
}
