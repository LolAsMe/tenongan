<?php

namespace App\Contracts\Tenongan;

use App\Models\Tenongan\Kas;

/**
 * Kas interface
 */
interface KasRepository
{
    public function increase(Kas $kas, array $attributes):void;
    public function decrease(Kas $kas, array $attributes):void;
}
