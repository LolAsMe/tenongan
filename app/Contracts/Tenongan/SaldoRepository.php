<?php

namespace App\Contracts\Tenongan;

use Illuminate\Database\Eloquent\Model;

/**
 * Saldo interface
 */
interface SaldoRepository
{
    public function increase(int $attributes);
    public function decrease(int $attributes);
}
