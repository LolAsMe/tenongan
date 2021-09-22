<?php

namespace App\Contracts\Tenongan;

use App\Models\Tenongan\Saldo;
use Illuminate\Database\Eloquent\Model;

/**
 * Saldo interface
 */
interface SaldoRepository
{
    public function increase(array $attribute);
    public function decrease(array $attribute);
    public function create();
    public function setOwner(Model $owner);
    public function setSaldo(Saldo $saldo);
}
