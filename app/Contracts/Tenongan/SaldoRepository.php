<?php

namespace App\Contracts\Tenongan;

use Illuminate\Database\Eloquent\Model;

/**
 * Saldo interface
 */
interface SaldoRepository
{
    public function increase(Model $Saldo, array $attributes):void;
    public function decrease(Model $Saldo, array $attributes):void;
}
