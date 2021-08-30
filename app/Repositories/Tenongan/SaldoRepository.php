<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\SaldoRepository as SaldoRepositoryContract;
use Illuminate\Database\Eloquent\Model;

/**
 * Saldo Repositry
 * mengatur saldo + log saldo
 */
class SaldoRepository implements SaldoRepositoryContract
{
    public function increase(Model $saldo,array $attribute):void
    {
        $saldo->increment('saldo', $attribute['jumlah']);
        $saldo->save();
        $saldo->logSaldo()->create($attribute);
    }

    public function decrease(Model $saldo,array $attribute):void
    {
        # code...
    }
}
