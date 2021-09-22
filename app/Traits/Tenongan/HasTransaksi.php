<?php

namespace App\Traits\Tenongan;

use App\Models\Tenongan\Transaksi;

trait HasTransaksiTrait
{
    protected Transaksi $transaksi;

    public function getTransaksi()
    {
        return $this->transaksi;
    }

    public function createTransaksi()
    {
        $this->transaksi = $this->transaksi()->create();
        return $this;
    }
}
