<?php

namespace App\Traits\Tenongan;

use App\Models\Tenongan\Pedagang;

trait PedagangServiceTrait
{
    protected Pedagang $pedagang;

    public function getPedagang()
    {
        return $this->pedagang;
    }

    public function createPedagang($attribute):Pedagang
    {
        return $this->pedagang = Pedagang::create($attribute)->createSaldo();
    }
}
