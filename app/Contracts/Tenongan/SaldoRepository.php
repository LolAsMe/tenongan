<?php

namespace App\Contracts\Tenongan;

use Illuminate\Database\Eloquent\Model;

/**
 * Saldo interface
 */
interface SaldoRepository
{
    public function increase(array $attribute);
    public function decrease(array $attribute);
}
