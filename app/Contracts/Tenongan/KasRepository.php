<?php

namespace App\Contracts\Tenongan;

use App\Models\Tenongan\Kas;
use Illuminate\Database\Eloquent\Model;

/**
 * Kas interface
 */
interface KasRepository
{
    public function increase(Kas $kas, array $attributes,Model $model):void;
    public function decrease(Kas $kas, array $attributes):void;
}
