<?php

namespace App\Contracts\Tenongan;



/**
 * TenonganService
 */
interface TenonganService
{
    public function tambahPenjualan(array $attribute);
    public function transact();
}
