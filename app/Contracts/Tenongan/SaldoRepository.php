<?php

namespace App\Contracts\Tenongan;

use Illuminate\Database\Eloquent\Model;

/**
 * Saldo interface
 */
interface SaldoRepository
{
    public function increase(Model $Saldo, int $attributes):void;
    public function decrease(Model $Saldo, int $attributes):void;
}
