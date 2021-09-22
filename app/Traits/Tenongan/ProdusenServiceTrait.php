<?php

namespace App\Traits\Tenongan;

use App\Models\Tenongan\Produsen;

trait ProdusenServiceTrait
{
    protected Produsen $produsen;

    public function getProdusen()
    {
        return $this->produsen;
    }

    public function createProdusen($attribute):Produsen
    {
        return $this->produsen = Produsen::create($attribute)->createSaldo();
    }
}
