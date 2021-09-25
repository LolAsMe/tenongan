<?php
namespace App\Traits\Tenongan;

use App\Models\Tenongan\Saldo;

trait HasSaldo
{
    protected Saldo $saldo;

    public function getSaldo()
    {
        return $this->saldo;
    }
    public function createSaldo()
    {
        $this->saldo = $this->saldo()->create();
        return $this;
    }
}
