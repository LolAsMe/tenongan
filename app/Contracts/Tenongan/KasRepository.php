<?php

namespace App\Contracts\Tenongan;

use App\Models\Tenongan\Kas;
use App\Models\Tenongan\KasHarian;
use Illuminate\Database\Eloquent\Model;

/**
 * Kas interface
 */
interface KasRepository
{
    public function increase(?array $attribute);
    public function decrease(?array $attribute);
    public function findPayer(array $attribute);
    public function getKas();
    public function getKasHarian();
    public function setKasHarianAttribute(array $attribute);
    public function setKasHarian(KasHarian $kasHarian);

}
